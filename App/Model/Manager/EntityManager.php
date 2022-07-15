<?php
namespace App\Model\Manager;

use App\Assets\Logger;
use App\Model\Entity\Entities;
use App\Model\Manager\Database;

class Entity
{    
    public Entities $entity;

    public function __construct(Entities $entity = null)    
    {                       
        if(isset($entity)){
            $this->entity = $entity;            
        }
        try{
            $this->db = Database::getConnection();                
        }
        catch(\PDOException $e){
            Logger::setMessage('Erreur de connexion à la BDD, code: BD-0000:'.$e);
            echo json_encode(['message' => 'error code BD-0000, please contact administrator']);
            die;
        }        
    }
    /**
     * @return Entities||bool Entity matching with entity from database or false of error
     * if the Id of object is set, return the single Object from database
     */
    public function getEntity(){           
        $entity_name = strtolower($this->entity->getEntityName());
                        
        $entity_id = $this->entity->id;
        $query = "SELECT * FROM $entity_name WHERE id=\"$entity_id\"";

        try {
            $sth = $this->db->prepare($query);
            $sth->setFetchMode(\PDO::FETCH_INTO, $this->entity);        
            $sth->execute();
             
            $response = $sth->fetch();
            Logger::setMessage('get Entity '.$entity_name. ' '.$this->entity->getId());
            return $response;
        }
        catch(\PDOException $e){
            Logger::setMessage($e->getMessage());
            return false;
        }
    }
    /**
     * @param array $cond  ["where", "equalto"]
     * @return array||bool array of entities from database, or bool false if error
     * return all response with the samed entity
     */
    public function getEntities($cond = null){           
        $entity_name = strtolower($this->entity->getEntityName());
                                    
         if($cond){
             $query = "SELECT * FROM $entity_name WHERE $cond[0]=\"$cond[1]\"";

         }else{
             $query = "SELECT * FROM $entity_name";
         }

        try {
            $sth = $this->db->prepare($query);
            $sth->setFetchMode(\PDO::FETCH_CLASS, get_class($this->entity));        
            $sth->execute();
             
            $response = $sth->fetchAll();
            Logger::setMessage('Getting Entities');
            return $response;
        }
        catch(\PDOException $e){
            Logger::setMessage($e->getMessage());
            return false;
        }
    }
    
    /**
     * @param string $query, the SQL query to execute
     * @param bool $bool true = FETCH_CLASS whereas FETCH
     * @return array|bool|Entities, array if Fetch, Entities if @param $bool at true and false if error
     */
    public function getWithQuery(string $query, $bool = true) :array|Entities|bool{        
        try{
            $sth = $this->db->prepare($query);
            if($bool === true){
                $sth->setFetchMode(\PDO::FETCH_CLASS, strtolower(get_class($this->entity)));
            }else{
                $sth->setFetchMode(\PDO::FETCH_ASSOC);
            }
            $sth->execute();        
            $response = $sth->fetchAll();
            http_response_code(200);
            Logger::setMessage('Entity Query');
            return $response;
        }
        catch(\PDOException $e){
            Logger::setMessage($e->getMessage());
            return false;
        }
    }
    
    /**
     * To update Entity, you need to create an entity and set the id
     *      
     * @param string $where = the where clause
     * @param string $cond = the condition equal to where clause
     * @param array $rows = [key => value, ....];
     */
    public function updateEntity(string $where, string $cond, array $rows) {
                
        $entity_name = strtolower($this->entity->getEntityName());

        $rows_keys = array_keys($rows);
        $set_rows_keys = implode(', ', array_map(function($value){
            return "$value=:$value";
        },$rows_keys));        

        $query = "UPDATE $entity_name SET $set_rows_keys WHERE $where=\"$cond\"";
        try{
            $sth = $this->db->prepare($query);
            foreach($rows as $key => $value){
                $sth->bindValue(":$key", $value);
            }
            $sth->execute();
            http_response_code(201);
            Logger::setMessage('Entity updated');
            return true;
        }
        catch(\PDOException $e){       
            Logger::setMessage($e->getMessage());
            return false;
        }
    }

    /**
     * @return Entities||bool Entity if persist is done and false if an error occured
     * 
     */
    public function persistEntity() :Entities|bool
    {
        
        $data_keys = array_keys(get_class_vars(get_class($this->entity)));              
        foreach($data_keys as $key=>$value){
            if(!isset($this->entity->$value)){
                unset($data_keys[$key]);
            }            
        }

        $params = implode(", ", $data_keys);

        $valueToBind = implode(", ", array_map(function($value){
            return ':'.$value;
        }, $data_keys));                                        

        $entity_name = strtolower($this->entity->getEntityName());

        $query = "INSERT INTO $entity_name($params) VALUES($valueToBind)";
        try{
            $sth = $this->db->prepare($query);                                          
            foreach($this->entity as $key => $value){
                $sth->bindValue(':'.$key, $value);
            }            
            $sth->execute();
            http_response_code(201);                                                 
        }
        catch(\PDOException $e){                                    
            Logger::setMessage($e->getMessage());
            return false;
        }           
        Logger::setMessage('Entity persisted');
        return $this->entity;
    }
    /**
     * Delete the current Entity 
     * @param string $entity the entity name to delete
     * @param string $where the condition
     * @param string $condition the "where is equal to"
     * @return bool true if deleted and false if error.
     */
    public function deleteEntity(string $entity, string $where, string $condition){              
        
        $query = "DELETE FROM $entity WHERE $where=\"$condition\"";
        try{
            $sth = $this->db->prepare($query);
            $sth->execute();
            Logger::setMessage('Entity deleted');
            return true;
        }
        catch(\PDOException $e){
            Logger::setMessage($e->getMessage());
            return false;
        }        
    }

    /**
     * @param Entities $child Class of child you want to fetch
     * @param bool $bool, if set to true, the childs is the parent
     * @return array||bool array of childs or false if error
     */
    public function getChilds(Entities $child, bool $bool = false) :array|bool{                     
        
        if($bool){
            $where = 'id';                            
            $the_id = strtolower(substr($child->getEntityName() , 0, -1).'_id');
            $entity_id = $this->entity->$the_id;
        }
        else{
            $where = strtolower(substr($this->entity->getEntityName() , 0, -1)).'_id';                                        
            $entity_id = $this->entity->id;        
        }

        $entity_name = strtolower($child->getEntityName());
        $query = "SELECT * FROM $entity_name WHERE $where = \"$entity_id\"";
        try{
            $sth = $this->db->prepare($query);
            $sth->execute();
    
            $sth->setFetchMode(\PDO::FETCH_CLASS, strtolower(get_class($child)));
            $response = $sth->fetchAll();              
            return $response;
        }                      
        catch(\PDOException $e){
            return false;
        }
    }
}