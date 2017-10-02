<?php

class Alm_Orderprocess_Block_Adminhtml_Orderprocess_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'orderprocess';
        $this->_controller = 'adminhtml_orderprocess';
        
        $this->_updateButton('save', 'label', Mage::helper('orderprocess')->__('Save Item'));
    }

    public function getHeaderText()
    {
         return Mage::helper('orderprocess')->__('Process Order');
    }
}
