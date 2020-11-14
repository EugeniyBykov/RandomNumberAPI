<?php 

namespace Database; 

trait GetConfig {

    /**
     * Get db config
     * 
     * @return Array 
     */
    private function getConfig() {
        $config = include($_SERVER["DOCUMENT_ROOT"].'/../Database/config.php'); 
        if (!$config) {
            echo 'Empty config file'; die; 
        } 
        
        return $config; 
    }
}