<?php 

namespace Database; 

use Database\Provider\DBInterface;

class Database {

    /**
     * Database connection
     */
    private $db;

	public function __construct (DBInterface $DB) {
        $this->db = $DB; 
    }
    

    /**
     * Execute sql query with params or without params
     * 
     * @param String $sql - sql query to execute
     * @param Bool $fetch - do we need fetch data or no
     * @param Array $params - array with params to bind 
     * 
     * @return mixed 
     */
    public function execute($sql, $fetch, $params = null) {
        return $this->db->execute($sql, $fetch, $params); 
    }
}
