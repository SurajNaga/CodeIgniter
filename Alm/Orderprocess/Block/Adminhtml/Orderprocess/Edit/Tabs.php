<?php

class Alm_Orderprocess_Block_Adminhtml_Orderprocess_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('orderprocess_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('orderprocess')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('orderprocess')->__('Item Information'),
          'title'     => Mage::helper('orderprocess')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('orderprocess/adminhtml_orderprocess_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}