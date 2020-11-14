<?php 

namespace Database\Provider; 

use PDO;
use PDOException;
use Database\GetConfig; 

/**
 * class to use for MYSQL Connection
 * 
 */
class MYSQL implements DBInterface {

    /**
     * last slq error
     */
    public $lastError;

    /**
     * PDO object
     */
    private $dbh;

    use GetConfig;

	public function __construct () { 
        $this->lastError = null; 
        $config = $this->getConfig();
        try {
            $this->dbh = new PDO(
                'mysql:host='.$config['mysql']['host'].';dbname='.$config['mysql']['dbname'],
                $config['mysql']['user'],
                $config['mysql']['pass']
            );
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        } catch( PDOException $e ) {
            $this->lastError = 'Error in database connection : ' . $e->getMessage();
            echo( $this->lastError );
            die; 
        }
	
    }

    /**
     * Execute sql query with params or without params
     * 
     * @param String $sql - sql query to execute
     * @param Array $params - array with params to bind 
     * 
     * @return mixed 
     */
    public function execute($sql, $fetch, $params = null) {

        if ($params != null && !is_array($params)) {
            $this->lastError = 'Query params should be Array type'; 
            echo( $this->lastError );
            die;  
            return false; 
        }
        try {
            $stmt = $this->dbh->prepare($sql); 
            if ($params != null)
                $res = $stmt->execute($params); 
            else 
                $res = $stmt->execute(); 
            
            if ($res) {
                if ($fetch)
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                else 
                    return true; 
            } else {    
                return false; 
            }
        } catch( PDOException $e ) {
            $this->lastError = 'Error to execute query : ' . $e->getMessage();
            echo( $this->lastError );
            return false; 
        }

    }

}