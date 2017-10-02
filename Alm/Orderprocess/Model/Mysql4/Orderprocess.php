<?php

class Alm_Orderprocess_Model_Mysql4_Orderprocess extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the orderprocess_id refers to the key field in your database table.
        $this->_init('orderprocess/orderprocess', 'orderprocess_id');
    }
}