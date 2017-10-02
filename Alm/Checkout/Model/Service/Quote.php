<?php
class Alm_Checkout_Model_Service_Quote extends Mage_Sales_Model_Service_Quote
{
	
 protected function _validate()
{
	$helper = Mage::helper('sales');
	if (!$this->getQuote()->isVirtual()) {
			$address = $this->getQuote()->getShippingAddress();
			$addressValidation = $address->validate();
	}
}
	
public function submitNominalItems()
{
	
	$this->_submitRecurringPaymentProfiles();
	$this->_inactivateQuote();
	$this->_deleteNominalItems();
}
}