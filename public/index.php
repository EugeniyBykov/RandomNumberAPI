<?php 

use App\Container;
use Routes\Dispatcher\Dispatcher;

// register autoloader 
include __DIR__ . '/../vendor/autoload.php';

// register dependencies 
require_once __DIR__ . '/../app/Container.php';
Container::register(); 

// register routes 
require_once __DIR__ .'/../Routes/routes.php';

// disptatching route 
require_once __DIR__ . '/../Routes/Dispatcher.php';
Dispatcher::dispatch(); 






    

?>