<?php

namespace App; 

trait Response {

    /**
     * prepare Responce data and status for router Dispatcher
     * 
     * @param Int $code - response status code
     * @param Array $data - response data 
     * 
     * @return Array
     */
    protected static function createResponse($code, $data) {
        return [
            'code' => $code,
            'data' => $data
        ];
    }

}