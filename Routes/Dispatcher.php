<?php 

namespace Routes\Dispatcher; 

use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;    
use Phroute\Phroute\Dispatcher as BaseDispatcher;
use App\Container;

class Dispatcher {

    /**
     * Phroute\Phroute\RouteCollector instance 
     */
    private static $_router;

    /**
     * Phroute\Phroute\Dispatcher instance 
     */
    private static $_dispatcher; 

    private function __construct() {
        self::$_router = Container::create('Phroute\Phroute\RouteCollector');
        self::$_dispatcher = new BaseDispatcher(self::$_router->getData());
    }

    /**
     * prepare uri sting 
     * 
     * @param String $uri
     * 
     * @return String
     */
    public static function processInput($uri){
        $uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        return $uri;
    }
    
    /**
     * Response to client
     * 
     * @param Array $response
     * 
     */
    public static function response($response){
        header("Content-type:application/json");
        http_response_code($response['code']);
        echo json_encode($response['data']);
    }

    /**
     * Dispatching routes and send responce
     * 
     */
    public static function dispatch() {

        if (self::$_router == null && self::$_dispatcher == null)
            new self; 

        try {

            $response = self::$_dispatcher->dispatch($_SERVER['REQUEST_METHOD'], self::processInput($_SERVER['REQUEST_URI']));
        
        } catch (HttpRouteNotFoundException $e) {
            self::response([
                    'code' => 404,
                    'data' => ['status'=>'wrong url']
            ]);
            return;
        } catch (HttpMethodNotAllowedException $e) {
            self::response([
                'code' => 405,
                'data' => ['status'=>'method not allowed']
            ]);
            return; 
        }

        self::response($response);
        
    }

    // prevent from clonning 
    private function __clone () {}
    // prevent from creating new instances
    private function __wakeup () {}
}
