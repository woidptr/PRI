<?php

namespace App\Utils;

include '../../../vendor/autoload.php';

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AttributeDriver;
use MongoDB\Client;

class Database {
    private static ?DocumentManager $documentManager = null;

    public static function getDocumentManager(): DocumentManager {
        if (self::$documentManager === null) {
            $config = new Configuration();
            $config->setProxyDir(__DIR__ . "/proxies");
            $config->setProxyNamespace("Proxies");
            $config->setHydratorDir(__DIR__ . "/hydrators");
            $config->setHydratorNamespace("Hydrators");
            $config->setDefaultDB("pri");
            $config->setMetadataDriverImpl(AttributeDriver::create(__DIR__ . "/Documents"));

            $client = new Client("mongodb://woid:helloworld@mongodb:27017");

            self::$documentManager = DocumentManager::create($client, $config);
        }

        return self::$documentManager;
    }
}

?>