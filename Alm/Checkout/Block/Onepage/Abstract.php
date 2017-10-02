<?php

abstract class Alm_Checkout_Block_Onepage_Abstract extends Mage_Checkout_Block_Onepage_Abstract
{
    protected function _getStepCodes()
    {
        return array('login', 'billing', 'shipping','payment', 'review');
    }
 }
