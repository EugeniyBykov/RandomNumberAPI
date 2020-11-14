<?php 

namespace App\Middleware;

use App\Token; 
use App\Response; 

class Auth {

    use Token, Response; 

    /**
     *  Token type 
     */
    const TOKEN_TYPE = 'Bearer';
    

    /**
     *  Check if user has token 
     */
    static public function isAuth() {

        $auth = $_SERVER['HTTP_AUTHORIZATION'];     
        session_start();
 
        if(isset($_COOKIE['token']) &&  // check if token ttl not expired 
                ( self::TOKEN_TYPE . ' ' . $_COOKIE['token'] === $auth ) && // check type of token
                ( $_SESSION['token'] === $_COOKIE['token'])  ) { // check if cookie token equel to session token 
            self::setTokenToCookie($_COOKIE['token']); // update token ttl 
            return null; 
        } 
        
        return self::createResponse(401, ['authorization status' => 'not authorized']); 
    }

}