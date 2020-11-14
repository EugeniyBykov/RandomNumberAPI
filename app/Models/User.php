<?php 

namespace App\Models; 

use Database\Database;

class User {
    
    /**
     * Database\Database  instance 
     * 
     */
    private $db; 

    public function __construct(Database $DB) {
        $this->db = $DB; 
    }

    /** 
     *  Check if user with this credentials exists
     * 
     * @param String $name 
     * @param String $pass
     * 
     * @return bool
     */
    public function authorize($login, $pass) {
        
        $params = [
            ':login' => $login,
            ':pass' => $pass
        ]; 
        $sql = "SELECT uid FROM users where login = :login AND pass = :pass";
        $result = $this->db->execute($sql, true, $params);
        return $result;

    }
}