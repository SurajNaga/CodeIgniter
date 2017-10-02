<?php
class Alm_Orderprocess_Block_Adminhtml_Orderprocess extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_orderprocess';
    $this->_blockGroup = 'orderprocess';
    $this->_headerText = Mage::helper('orderprocess')->__('Process Order');
    parent::__construct();
  }
}
