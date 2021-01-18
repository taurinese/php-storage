<?php

session_start();

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// SESSION

/* $store = new App\Storage\SessionStorage; */

/// FILES

/* $store = new App\Storage\FileStorage; */

/// DATABASE (MYSQL)

$store = new App\Storage\DatabaseStorage;


$store->set('name', 'Clement');

/* $store->set('age', 33); */

/* $store->delete('name'); */

/* $store->destroy();  */

echo $store->get('name');

/* print_r($store->all()); */