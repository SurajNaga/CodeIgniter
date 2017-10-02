<?php
require_once 'Mage/Checkout/controllers/IndexController.php';
class Alm_Checkout_IndexController extends Mage_Checkout_IndexController
{
    function indexAction()
    {
		 
		$flag = Mage::getModel('alm_checkout/checkout')->validateFlag();  
		echo $flag;
		exit;
		switch ($flag){
			case 1:
				
				$this->_redirect('checkout/onepage/shippingprocess');
				break;
			case 2:
				 $this->_redirect('checkout/onepage', array('_secure'=>true));
    }
					
		}
       
}
