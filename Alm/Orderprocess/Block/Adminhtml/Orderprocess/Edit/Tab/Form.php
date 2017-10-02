<?php

class Alm_Orderprocess_Block_Adminhtml_Orderprocess_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
 protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('orderprocess_form', array('legend'=>Mage::helper('orderprocess')->__('Quote Shipping Price')));
     
      $fieldset->addField('quote_id', 'text', array(
      		'label'     => Mage::helper('reports')->__('Quote Id'),
      		'class'     => 'required-entry',
      		'required'  => true,
      		'name'      => 'quote_id',
      		'readonly' =>true,
      ));
      
      $fieldset->addField('ship_price', 'text', array(
          'label'     => Mage::helper('reports')->__('Ship Price'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'ship_price',
      ));

    
		
     /* $fieldset->addField('ship_flag', 'select', array(
          'label'     => Mage::helper('reports')->__('Status'),
          'name'      => 'ship_flag',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('orderprocess')->__('Completed'),
              ),

              array(
                  'value'     => 0,
                  'label'     => Mage::helper('orderprocess')->__('Pending'),
              ),
          ),
      ));
     */
    
     
      if ( Mage::getSingleton('adminhtml/session')->getorderprocessData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getorderprocessData());
          Mage::getSingleton('adminhtml/session')->setorderprocessData(null);
      } elseif ( Mage::registry('orderprocess_data') ) {
          $form->setValues(Mage::registry('orderprocess_data'));
      }
      return parent::_prepareForm();
  }
}
