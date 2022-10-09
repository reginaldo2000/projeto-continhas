<?php

namespace Source\Util;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{

    private static $isDevMode = true;
    private static $proxyDir = null;
    private static $cache = null;
    private static $useSimpleAnnotationReader = false;
    private static $instance = null;

    public static function getEntityManager(): EntityManager
    {
        $config = ORMSetup::createAnnotationMetadataConfiguration(
            array(__DIR__ . "/../../source"),
            self::$isDevMode,
            self::$proxyDir,
            self::$cache,
            self::$useSimpleAnnotationReader
        );
        $conn = array(
            "url" => "mysql://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB_NAME
        );
        if (self::$instance == null) {
            self::$instance = EntityManager::create($conn, $config);
        }
        return self::$instance;
    }
}
