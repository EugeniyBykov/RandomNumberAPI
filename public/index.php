<?php 

use App\Container;
use Routes\Dispatcher\Dispatcher;

// register autoloader 
include $_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php';

// register dependencies 
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/Container.php';
Container::register(); 

// register routes 
require_once $_SERVER['DOCUMENT_ROOT'] .'/../Routes/routes.php';

// disptatching route 
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Routes/Dispatcher.php';
Dispatcher::dispatch(); 






    

?>