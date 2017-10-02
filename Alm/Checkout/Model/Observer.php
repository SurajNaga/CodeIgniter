<?php
class Alm_Checkout_Model_Observer{
	public function updateShippingFlag(){
		
		Mage::getModel('alm_checkout/checkout')->updateShipingFlag();
	}
	public function getCurrentQuoteId(){
		
		   $id =  Mage::getSingleton('checkout/session')->getQuoteId(); 
		  //Mage::register('my_quote', $id);
		
	}
}
