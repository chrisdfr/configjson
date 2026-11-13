<?php

/**
 * example.php
 * @Auteur: Christophe Dufour
 */

declare(strict_types=1);

use ChrisDfr\ConfigJSON\ConfigJSON as Cfg;

require dirname(__DIR__) . str_replace("/", DIRECTORY_SEPARATOR, "/vendor/autoload.php");

try {
    Cfg::load(dirname(__DIR__) . str_replace("/", DIRECTORY_SEPARATOR, "/config/conf.json"));
}
catch(Exception $e) {
    echo $e->getMessage();
    exit(1);
}

echo "User: " . Cfg::$setting["user"] . 
    " (" . Cfg::$setting["infos"]["firstname"] . 
    " " . Cfg::$setting["infos"]["name"] . ")";
