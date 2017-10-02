<?php

class Alm_Orderprocess_Model_Status extends Varien_Object
{
    const STATUS_ENABLED	= 2;
    const STATUS_DISABLED	= 1;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('orderprocess')->__('Completed'),
            self::STATUS_DISABLED   => Mage::helper('orderprocess')->__('Pending')
        );
    }
}