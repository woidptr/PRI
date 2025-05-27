<?php

namespace App\Utils;

require_once __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../utils/settings.php';

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AttributeDriver;
use MongoDB\Client;
use App\Utils\Settings;

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

            $url = sprintf("mongodb://%s:%s@mongodb:27017", Settings::$mongoUser, Settings::$mongoPassword);

            $client = new Client($url);

            self::$documentManager = DocumentManager::create($client, $config);
        }

        return self::$documentManager;
    }
}

?>