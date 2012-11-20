<?php

require_once '../../bootstrap.php';

class OrderControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIndexActionDispatchedCorrectly()
    {
        $this->dispatch('/order');
        $this->assertController('order');
        $this->assertAction('index');
    }

    public function testCreateActionDispatchedCorrectly()
    {
        $this->dispatch('/order/create');
        $this->assertController('order');
        $this->assertAction('create');
    }

    public function testUpdateActionDispatchedCorrectly()
    {
        $this->dispatch('/order/update');
        $this->assertController('order');
        $this->assertAction('update');
    }

    /*public function testDeleteActionDispatchedCorrectly()
    {
        $this->dispatch('/order/delete');
        $this->assertController('order');
        $this->assertAction('delete');
    }*/
}
