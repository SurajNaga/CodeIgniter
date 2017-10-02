<?php
class Alm_Fee_Model_Fee extends Varien_Object{
	

	public static function getFee(){
		$price =  Mage::getModel('alm_checkout/checkout')->getShipPrice(); 
		return $price;
		
		
	}
	public static function canApply($address){
		//put here your business logic to check if fee should be applied or not
		//if($address->getAddressType() == 'billing'){
		return true;
		//}
	}
}