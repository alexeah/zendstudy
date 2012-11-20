<?php

require_once '../../bootstrap.php';
require_once '../../../application/Bootstrap.php';

class ModelOrderTest extends Zend_Test_PHPUnit_DatabaseTestCase
{
    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        $dataSet = new Zend_Test_PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            APPLICATION_PATH . '/../tests/fixtures/sites/orders.yaml'
        );

        return $dataSet;
    }

    public function testAddsUsageFilterByDefaultWhenReturnsAllOrders()
    {
        $unit = new Application_Model_Order();

        $orders = $unit->findAll();

        $this->assertInstanceOf('Zend_Collection', $orders);
        $this->assertEquals(2, $orders->count());
    }
}
