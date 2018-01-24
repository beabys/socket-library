<?php

namespace SocketChair\Models;

use SocketLibrary\Traits\ConfigurationTrait;
use LessQL\Database;
use PDO;
use SocketLibrary\Configurations\Configuration;

class Model extends Database
{
    use ConfigurationTrait;

    public function __construct($configuration)
    {
        $this->setConfiguration($configuration);
        $host = ($configuration instanceof Configuration) && $configuration->get('database.host') ? $configuration->get('database.host') : 'localhost';
        $port = ($configuration instanceof Configuration) && $configuration->get('database.port') ? $configuration->get('database.port') : 3306;
        $username = ($configuration instanceof Configuration) && $configuration->get('database.username') ? $configuration->get('database.username') : '';
        $password = ($configuration instanceof Configuration) && $configuration->get('database.password') ? $configuration->get('database.password') : '';
        $database = ($configuration instanceof Configuration) && $configuration->get('database.database') ? $configuration->get('database.database') : 'test';
        $pdo = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database, $username, $password);
        paren::_construct($pdo);
    }
}
