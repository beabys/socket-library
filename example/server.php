<?php

require __DIR__ . '/../vendor/autoload.php';

use SocketLibrary\Servers\Server;
use SocketLibrary\Configurations\Configuration;

$configs = include __DIR__ . '/../config.php';
$configuration = new Configuration($configs);
(new Server($configuration))->loop();
