<?php
include '../vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src'],
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'dbname' => 'pri',
    'user' => getenv("DB_USER"),
    'password' => getenv("DB_PASSWORD"),
    'host' => '127.0.0.1',
    'driver' => 'pdo_pgsql',
], $config);

$entt = new EntityManager($connection, $config);

?>