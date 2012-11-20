<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIndexAction()
    {
        $params = array('action' => 'index', 'controller' => 'customers', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        $this->assertController('customers');
        $this->assertAction('index');
        $this->assertResponseCode(200);
    }

    public function testAddAction()
    {
        $params = array('action' => 'add', 'controller' => 'customers', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        // post data generating
        $randFirstName = substr(md5(rand(0, 9999), 12);
        $randSecondName = substr(md5(rand(0, 9999), 6);
        // request to add new record
        $this->getRequest()
            ->setMethod('POST')
            ->setPost(array(
                'first_name' => $randFirstName,
                'second_name' => $randSecondName,
            ));
        // check we were redirected to index page
        $paramsForUrlToRedirect = array('action' => 'index', 'controller' => 'customers', 'module' => 'default');
        $urlParams = $this->urlizeOptions($paramsForUrlToRedirect);
        $url = $this->url($urlParams);
        $this->assertRedirectTo($url);
        $this->assertResponseCode(200);
        // check record was added
        $this->assertQueryContentContains('.customers .customer', "$randFirstName $randSecondName");
    }

    public function testRemoveAction()
    {
        $params = array('action' => 'remove', 'controller' => 'customers', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        $this->assertController('customers');

        $paramsForUrlToRedirect = array('action' => 'index', 'controller' => 'customers', 'module' => 'default');
        $urlParams = $this->urlizeOptions($paramsForUrlToRedirect);
        $url = $this->url($urlParams);
        $this->assertRedirectTo($url);
        $this->assertResponseCode(200);
    }
}
