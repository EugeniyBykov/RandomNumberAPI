<?php

namespace App\Controllers;

use App\Container; 
use App\Models\RandomNumber; 


class RandomNumberController extends BaseController{

    /**
     * App\Models\RandomNumber instance
     */
    private $randomNumber; 

    /**
     * minimal value to generate new number
     */
    const MIN = 1; 

    /**
     * maximal value to generate new number
     */
    const MAX = 100000; 

    public function __construct() {
        $db = Container::create('Database\Database');
        $this->randomNumber = new RandomNumber($db); 
    }

    /**
     * Create new random number 
     * 
     * @return Array
     */
    public function generate() {
        $uid = $this->generateMd5Hash(); 
        $value = rand(self::MIN, self::MAX); 
        $result = $this->randomNumber->generate($uid, $value);
        if ($result) 
            return self::createResponse(200, ["id" => $uid, "value" => $value]); 
        else 
            return self::createResponse(500, ['failed to generate' => 'server error']); 

        
    }

    /**
     * Retrieve existing random number by id
     * 
     * @return Array
     */
    public function retrieve() {
        $id = isset($_GET['id']) ? $_GET['id'] : null; 
        if ($id !== null) {
            $value = $this->randomNumber->retrieve($id);
        } else {
            return self::createResponse(200, ["status" => 'empty ID param']); 
        }

        if ($value) {
            return self::createResponse(200, [ "value" => $value[0]['value'] ]); 
        }
    }
    
}