<?php 

namespace App; 

trait Token {


    /**
     *  Generate unique token
     * 
     * @return String md5 unique hash
     */
    protected static function generateMd5Hash() {
        return md5(time()); 
    }

    /**
     * Set Token to cookie
     * @param String $token
     */
    protected static function setTokenToCookie($token) {
        setcookie('token', $token, time() + 60); 
    }

}