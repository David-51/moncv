<?php
namespace App\Model\Manager;

use App\Assets\Logger;

use App\Model\Manager\Database;

class Entity
{    

    public function __construct()    
    {                               
        try{
            $this->db = Database::getConnection();                
        }
        catch(\PDOException $e){
            Logger::setMessage('Erreur de connexion à la BDD, code: BD-0000:'.$e);
            echo json_encode(['message' => 'error code BD-0000, please contact administrator']);
            die;
        }        
    }
    // Setter and getter 
    public function setId($id) :self{
        $this->id = $id;
        return $this;
    }
    public function getId() :string {
        return $this->id;
    }

    /**
     * @return string name of the current entity
     */
    public function getEntityName() :string{
        $class = get_class($this);
        return substr($class, strrpos($class, '\\') + 1);
    }
    
    /**
     * convert IP Adress in hexadecimal
     * @return string Ip adress in hexadecimal
     */
    private function ipToHex(){
        $remote = $_SERVER['REMOTE_ADDR'];
        $explode_remote = explode('.', $remote);
        
        for($i = 0; $i<4 ; $i++){            
            if(!isset($explode_remote[$i])){
                $explode_remote[$i] = rand(0,255);
            }
            if(intval($explode_remote[$i])<16){
                $ip[] = '0'.dechex(intval($explode_remote[$i]));
            }
            else{
                $ip[] = dechex(intval($explode_remote[$i]));
            }
        }                    
        return implode('', $ip);
    }
    /**
     * first digit are based on the current timestamp in micro second, and the last digit are the request IP.
     * all is converted on base 64 code
     * @return string UUID
     */
    public function setUniqId(){        
        $uniqid = uniqid(true);    
        return substr($uniqid, 0, 8). '-' . substr($uniqid, 8, 4) . '-' . substr($uniqid, 12, 2). bin2hex(random_bytes(1)) . '-' . bin2hex(random_bytes(2)) . '-' . bin2hex(random_bytes(2)) . $this->ipToHex();
    }
    /**
     * @return Entity||bool Entity matching with entity from database or false of error
     * if the Id of object is set, return the single Object from database
     */
    public function getEntity(){           
        $entity_name = strtolower($this->getEntityName());
                        
        $entity_id = $this->getId();
        $query = "SELECT * FROM $entity_name WHERE id=\"$entity_id\"";

        try {
            $sth = $this->db->prepare($query);
            $sth->setFetchMode(\PDO::FETCH_INTO, $this);        
            $sth->execute();
             
            $response = $sth->fetch();
            Logger::setMessage('get Entity '.$entity_name. ' '.$this->getId());
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
        $entity_name = strtolower($this->getEntityName());
                                    
         if($cond){
             $query = "SELECT * FROM $entity_name WHERE $cond[0]=\"$cond[1]\"";

         }else{
             $query = "SELECT * FROM $entity_name";
         }

        try {
            $sth = $this->db->prepare($query);
            $sth->setFetchMode(\PDO::FETCH_CLASS, get_class($this));        
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
    public function getWithQuery(string $query, $bool = true) :array|Entity|bool{        
        try{
            $sth = $this->db->prepare($query);
            if($bool === true){
                $sth->setFetchMode(\PDO::FETCH_CLASS, strtolower(get_class($this)));
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
                
        $entity_name = strtolower($this->getEntityName());

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
     * @return Entity||bool Entity if persist is done and false if an error occured
     * 
     */
    public function persistEntity() :Entity|bool
    {
        
        $data_keys = array_keys(get_class_vars(get_class($this)));              
        foreach($data_keys as $key=>$value){
            if(!isset($this->$value)){
                unset($data_keys[$key]);
            }            
        }

        $params = implode(", ", $data_keys);

        $valueToBind = implode(", ", array_map(function($value){
            return ':'.$value;
        }, $data_keys));                                        

        $entity_name = strtolower($this->getEntityName());

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
}