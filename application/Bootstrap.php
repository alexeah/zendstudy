<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function __construct($application)
    {
        require_once('ZFDebug/Debug.php');
        Zend_Controller_Front::getInstance()->registerPlugin(new ZFDebug_Controller_Plugin_Debug());
        parent::__construct($application);
    }
}