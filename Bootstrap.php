<?php

use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap {

    protected static $serviceManager;
    protected static $entityPaths = array();
    protected static $dropCreateSchemaExecutado = false;

    public static function init() {

        $zf2ModulePaths = array(__DIR__);
        if (($path = static::findParentPath('vendor'))) {
            $zf2ModulePaths[] = $path;
        }
        if (($path = static::findParentPath('module')) !== $zf2ModulePaths[0]) {
            $zf2ModulePaths[] = $path;
        }

        static::$entityPaths[] = static::findParentPath('module') . '/Forum/src/Forum/Model/Entidade';
//        print static::findParentPath('test').'/autoload/doctrine.local.php';
        static::initAutoloader();
        // use ModuleManager to load this module and it's dependencies
        $config = array(
            'module_listener_options' => array(
                'module_paths' => $zf2ModulePaths,
                'config_glob_paths' => array(
                    'test-config/autoload/{,*.}{global,local}.php'
                ),
            ),
            'modules' => array(
                'DoctrineModule',
                'DoctrineORMModule',
                'Application',
                'Calc',
                'Forum'
            )
        );


        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();
        static::$serviceManager = $serviceManager;
    }

    public static function dropCreateSchema($em) {
        $metadatas = $em->getMetadataFactory()->getAllMetadata();
        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($em);
        $schemaTool->dropSchema($metadatas);
        $schemaTool->createSchema($metadatas);
    }

    public static function getEntityManager() {
        $em = static::getServiceManager()->get('Doctrine\ORM\EntityManager');
        if (!static::$dropCreateSchemaExecutado) {
            static::dropCreateSchema($em);
            static::$dropCreateSchemaExecutado = true;
        }
        return $em;
    }

    public static function chroot() {
        $rootPath = dirname(static::findParentPath('module'));
        print 'ROOT ' . $rootPath . "\n";
        chdir($rootPath);
    }

    public static function getServiceManager() {
        return static::$serviceManager;
    }

    protected static function initAutoloader() {
        $vendorPath = static::findParentPath('vendor');

        $zf2Path = getenv('ZF2_PATH');
        if (!$zf2Path) {
            if (defined('ZF2_PATH')) {
                $zf2Path = ZF2_PATH;
            } elseif (is_dir($vendorPath . '/ZF2/library')) {
                $zf2Path = $vendorPath . '/ZF2/library';
            } elseif (is_dir($vendorPath . '/zendframework/zendframework/library')) {
                $zf2Path = $vendorPath . '/zendframework/zendframework/library';
            }
        }

        if (!$zf2Path) {
            throw new RuntimeException(
            'Unable to load ZF2. Run `php composer.phar install` or'
            . ' define a ZF2_PATH environment variable.'
            );
        }

        if (file_exists($vendorPath . '/autoload.php')) {
            include $vendorPath . '/autoload.php';
        }



        include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
        AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                'autoregister_zf' => true,
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
                )
            ),
        ));
        set_include_path(implode(PATH_SEPARATOR, array(
            $vendorPath . '/hamcrest/hamcrest-php/hamcrest',
            get_include_path()
        )));

        require_once 'Hamcrest.php';
    }

    protected static function findParentPath($path) {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) {
                return false;
            }
            $previousDir = $dir;
        }
        return $dir . '/' . $path;
    }

}

Bootstrap::init();
Bootstrap::chroot();

/**
 * Como várias dependencias possuem a função anything(), esta é a que o phockito
 * entende
 */
function qualquerCoisa($description = 'ANYTHING') {

    require_once 'Hamcrest/Core/IsAnything.php';
    return Hamcrest_Core_IsAnything::anything($description);
}
