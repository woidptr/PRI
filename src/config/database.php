<?php
include '../vendor/autoload.php';

namespace App\Config;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Database {
    private static ?EntityManager $entityManager = null;

    public static function getEntityManager(): EntityManager {
        if (self::entityManager === null) {
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
            
            self::entityManager = new EntityManager($connection, $config);
        }

        return self::entityManager;
    }
}

?>