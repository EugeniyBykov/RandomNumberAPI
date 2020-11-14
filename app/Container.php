<?php 

namespace App; 

use Dice\Dice; 

final class Container {

    /**
     *   Dice\Dice instance for application
     */
    private static $_instance = null;

    private function __construct() {
        self::registerDependencies(); 
    }

    /**
     * Register basic dependencies for project
     * 
     */
    private static function registerDependencies() {

        self::$_instance = new Dice();

        // register Database
        self::$_instance = self::$_instance->addRules(
            [
            'Database\Database' => [
                'shared' => true,
                'substitutions' => [
                    'Database\Provider\\DBInterface' => 'Database\Provider\MYSQL'
                ],
            ]
        ]); 
        self::$_instance->create('Database\Database');

        // register Router
        self::$_instance = self::$_instance->addRules([
                'Phroute\Phroute\RouteCollector' => [
                    'shared' => true
                ]
            ]
        ); 
        self::$_instance->create('Phroute\Phroute\RouteCollector');
    } 

    /**
     * Get instance of container where we need it to use
     * 
     * @return Container
     */
    public static function register() {

        if (self::$_instance != null) {
            return self::$_instance;
        }

        return new self;
    } 

    /**
     * Call create method of Dice container
     *  we can use it if we need create new clas without any additional rules
     * 
     * @param String $className
     * 
     * @return mixed new instance of class
     */
    public static function create($className) {
        if (self::$_instance === null) {
            new self;
        }

        return self::$_instance->create($className);
    }

    /**
     * return native Dice container
     *  we can use it if we need create new clas with additional rules
     * 
     * @param String $className
     * 
     * @return mixed new instance of class
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            return self;
        }

        return new self; 
    }

    // prevent from clonning 
    private function __clone () {}
    // prevent from creating new instances
    private function __wakeup () {}
    

}