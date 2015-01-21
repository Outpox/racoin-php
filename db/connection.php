<?php

namespace db;

use Illuminate\Database\Capsule\Manager as DB;

class connection {

    public static function createConn() {
        $capsule = new DB;
        $capsule->addConnection(parse_ini_file("./config/config.ini"));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}