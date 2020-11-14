<?php


namespace Fournisseur;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Fournisseur\Model\Fournisseur;
use Fournisseur\Model\FournisseurTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
//***************************************start code for adding modeltable
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Fournisseur\Model\FournisseurTable' =>  function($sm) {
                    $tableGateway = $sm->get('FournisseurTableGateway');
                    $table = new FournisseurTable($tableGateway);
                    return $table;
                },
                'FournisseurTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Fournisseur());
                    return new TableGateway('fou__fournisseur', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

//********************************end




    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}