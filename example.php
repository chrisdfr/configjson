<?php

/**
 * example.php
 * @Auteur: Christophe Dufour
 */

declare(strict_types=1);

use ChrisDfr\ConfigJSON\ConfigJSON as Cfg;

require "./vendor/autoload.php";

try {
    Cfg::load("./config/conf.json");
}
catch(Exception $e) {
    echo $e->getMessage();
    exit(1);
}

echo "User: " . Cfg::$setting["user"] . 
    " (" . Cfg::$setting["infos"]["firstname"] . 
    " " . Cfg::$setting["infos"]["name"] . ")";