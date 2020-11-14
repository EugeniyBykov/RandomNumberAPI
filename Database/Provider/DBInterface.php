<?php

namespace Database\Provider; 

interface DBInterface {

    public function execute($sql, $fetch, $params = null);

}