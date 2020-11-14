<?php
    
    use App\Container;

    $router = Container::create('Phroute\Phroute\RouteCollector');
    
    // create auth middleware
    $router->filter('is_auth',['App\Middleware\Auth', 'isAuth']);

    $router->post('/api/auth', ['App\Controllers\UserController', 'authorizeUser']);

    $router->group(array('before' => 'is_auth'), function($router){

        $router->get('/api/retrieve',['App\Controllers\RandomNumberController', 'retrieve']);

        $router->get('/api/generate', ['App\Controllers\RandomNumberController', 'generate'] );  
  
    });



?>