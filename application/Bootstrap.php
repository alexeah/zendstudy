<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function __construct($application)
    {
        require_once('ZFDebug/Debug.php');
        Zend_Controller_Front::getInstance()->registerPlugin(new ZFDebug_Controller_Plugin_Debug());
        parent::__construct($application);
    }

    public function _initRoute()
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();

        $routeCustomersEdit = new Zend_Controller_Router_Route(
                '/customers/:id/edit/',
                [
                    'controller' => 'customers',
                    'action' => 'edit',
                    'id' => 1,
                ]
        );
        $router->addRoute('default', $routeCustomersEdit);

        $routeCustomersRemove = new Zend_Controller_Router_Route(
                '/customers/:id/remove/',
                [
                    'controller' => 'customers',
                    'action' => 'remove',
                    'id' => 1,
                ]
        );
        $router->addRoute('customersRemove', $routeCustomersRemove);
    }
}