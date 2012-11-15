<?php

class Application_Model_Order extends Zend_Db_Table_Abstract
{
    protected $_name = 'order';
    protected $_primary = 'id';

    public function getAll()
    {
        return $this->fetchAll($this->select()->from($this->_name));
    }
}