<?php

namespace App\Model\Entity;

use App\Model\Manager\Entity;

class Entities
{    

    public function setId($id) :self{
        $this->id = $id;
        return $this;
    }
    public function getId() :string {
        return $this->id;
    }

    public function getEntityName() :string{
        $class = get_class($this);
        return substr($class, strrpos($class, '\\') + 1);
    }

    public function setEntityManager() :Entity{
        return new Entity($this);        
    }
    
    // convert IP Adress in hexadecimal
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
     */
    public function setUniqId(){        
        $uniqid = uniqid(true);    
        return substr($uniqid, 0, 8). '-' . substr($uniqid, 8, 4) . '-' . substr($uniqid, 12, 2). bin2hex(random_bytes(1)) . '-' . bin2hex(random_bytes(2)) . '-' . bin2hex(random_bytes(2)) . $this->ipToHex();
    }
    
    /**
     * @return bool true if deleted and false if error
     */
    public function delete() :bool{
        return $this->setEntityManager()->deleteEntity($this->getEntityName(), 'id', $this->getId());
    }
    
}