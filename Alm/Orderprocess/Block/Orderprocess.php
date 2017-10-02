<?php
class Alm_Orderprocess_Block_Orderprocess extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getOrderprocess()     
     { 
        if (!$this->hasData('orderprocess')) {
            $this->setData('orderprocess', Mage::registry('orderprocess'));
        }
        return $this->getData('orderprocess');
        
    }
}