<?php

class Application_Model_Customers extends Zend_Db_Table_Abstract
{
    protected $_name = 'customers';
    protected $_primary = 'id';

    public function getAll()
    {
        return $this->fetchAll($this->select()->from($this->_name));
    }
}