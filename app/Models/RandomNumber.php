<?php 

namespace App\Models; 

use Database\Database;

class RandomNumber {

    /**
     * Database\Database  instance 
     * 
     */
    private $db; 

    public function __construct(Database $DB) {
        $this->db = $DB; 
    }

    /** 
     *  Generate random number
     * 
     * @param String $uid - unique uid 
     * @param Int $value - new random value
     * 
     * @return bool
     */
    public function generate($uid, $value) {

        $params = [
            ':uid' => $uid,
            ':value' => $value
        ]; 
        $sql = 'INSERT into numbers (uid, value) VALUES(:uid, :value)'; 
        $result = $this->db->execute($sql, false, $params);
        return $result;
    }
     /** 
     *  Get random number by id 
     * 
     * @param String $id - value uid
     * 
     * @return Array - db select result
     */
    public function retrieve($id) {
        $params = [
            ':uid' => $id
        ]; 
        $sql = 'SELECT value from numbers WHERE uid = :uid'; 
        $result = $this->db->execute($sql, true, $params);
        return $result;
    }


}