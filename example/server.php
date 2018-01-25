<?php

require __DIR__ . '/../vendor/autoload.php';

use SocketLibrary\Servers\Server;
use SocketLibrary\Configurations\Configuration;
use SocketLibrary\Strategies\Strategy;

//array of configs
$configs = include __DIR__ . '/config.php';
//create instance of configuration
$configuration = new Configuration($configs);
//create new instance of server
$server = new Server($configuration);
//set instance of strategy for the response
$server->setStrategy(new Strategy);
//start server ((optional) adding v or vv for verbose mode)
$server->loop();
