<?php 

namespace App\Controllers;

use App\Models\User; 
use App\Container; 

class UserController extends BaseController {

    /**
     * App\Models\User instance
     */
    private $user; 

    public function __construct() { 
        $db = Container::create('Database\Database'); 
        $this->user = new User($db); 
    }

    /**
     *  Check if user exist and return token
     * 
     * @return Array 
     */
    public function authorizeUser() {
        $login = isset($_POST['login']) ? $_POST['login'] : null; 
        $pass = isset($_POST['pass']) ? $_POST['pass'] : null; 

        if ($login === null || $pass === null) {
            return self::createResponse('401', ['authorization status' => 'empty credentials']);
        }

        // if we allow to use it anybody (not only users from db)
        // we can just $authotization = true; 
        $authotization =  $this->user->authorize($login, $pass);
        if ($authotization) {
            $token = self::generateMd5Hash(); 
            session_start();
            $_SESSION['token'] = $token;
            self::setTokenToCookie($token);  
            return self::createResponse('200', ['token' => $token]);
        } else {
            return self::createResponse('401', ['authorization status' => 'wrong credentials']);
        }

    }
}