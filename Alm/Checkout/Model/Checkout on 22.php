<?php
class Alm_Checkout_Model_Checkout extends Mage_Core_Model_Abstract {
	
	public function _construct()
	{
		parent::_construct();
		$this->_init('checkout/checkout');
	}
	public function read(){
		return  Mage::getSingleton('core/resource')->getConnection('core_read');
	}
	public function write(){
		return  Mage::getSingleton('core/resource')->getConnection('core_write');
	}
	public function getCurrentQuoteId(){
		return Mage::getSingleton('checkout/session')->getQuoteId();
			
	}
	public function validateCustomer(){
		return Mage::getSingleton('customer/session')->getCustomerId();
	}
	public function validateFlag(){
		if($this->validateCustomer()){
			$id = $this->getCurrentQuoteId();
			$sql = "select ship_flag from sales_flat_quote where entity_id = $id";
			$flag = $this->read()->fetchOne($sql);
			switch ($flag){
				case 0:
				case 1:	
					//$this->updateShipingFlag();
					return 1;
					break;
				default:
					return $flag;	
					
			}
		}else{
			Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
		}
		
	}
	public function updateShipingFlag(){
		$id = $this->getCurrentQuoteId();		
		$sql = "update sales_flat_quote set ship_flag=1 where entity_id =$id";
		$this->write()->query($sql);	
	}
	
	public function getShipPrice(){ 
				
		 $quote_id = Mage::getSingleton('checkout/session')->getQuoteId();
		 
		 if(!empty($quote_id)){ 
		$sql = "select ship_price from sales_flat_quote where entity_id = $quote_id";  
		 $result =  $this->read()->fetchOne($sql);
		 return $result; 
		 }else {
		 	return 0;
		 }
		 	
		exit;
	}
	
	public function shipmentbefore(){
		
         $to  = Mage::getSingleton('customer/session')->getCustomer()->getEmail(); 
         $name = Mage::getSingleton('customer/session')->getCustomer()->getName();
         
          // Transactional Email Template's ID
    $templateId = 1;
 
    // Set sender information          
    $senderName = Mage::getStoreConfig('trans_email/ident_support/name');
    $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');    
    $sender = array('name' => $senderName,
                'email' => $senderEmail);
     
    // Set recepient information
    $recepientEmail = $to;
    $recepientName = $name;       
     
    // Get Store ID    
    $store = Mage::app()->getStore()->getId();
 
    // Set variables that can be used in email template
   
    $vars = array();
    $vars['customerName'] = 'Branko';
    $vars['customerEmail'] = 'Ajzele';
             
    $translate  = Mage::getSingleton('core/translate');
 
    // Send Transactional Email
    Mage::getModel('core/email_template')
		->addBcc('vipin.vs1987@gmail.com')
        ->sendTransactional($templateId, $sender, $recepientEmail, $recepientName, $vars, $storeId);
             
    $translate->setTranslateInline(true);   
         
        
          
	}
	public function ordership()
	{
		      // Transactional Email Template's ID
			  //$to  = Mage::getSingleton('customer/session')->getCustomer()->getEmail(); 
         $name = Mage::getSingleton('customer/session')->getCustomer()->getName();
    $templateId = 2;
 
    // Set sender information          
    $senderName = Mage::getStoreConfig('trans_email/ident_support/name');
    $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');    
    $sender = array('name' => $senderName,
                'email' => $senderEmail);
     
    // Set recepient information
    $recepientEmail = "orders@almahroosonline.com";
    $recepientName = $name;    
	/*$cc='sajanpayyannur@gmail.com';   */
     
    // Get Store ID    
    $store = Mage::app()->getStore()->getId();
 
    // Set variables that can be used in email template
   
    $vars = array();
    $vars['customerName'] = 'Branko';
    $vars['customerEmail'] = 'Ajzele';
             
    $translate  = Mage::getSingleton('core/translate');
 
    // Send Transactional Email
    Mage::getModel('core/email_template')
	 	
        ->sendTransactional($templateId, $sender, $recepientEmail, $recepientName, $vars, $storeId);
             
    $translate->setTranslateInline(true);
	}
	public function aftershipment($email){
		$templateId = 2;
 
    // Set sender information          
    $senderName = Mage::getStoreConfig('trans_email/ident_support/name');
    $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');    
    $sender = array('name' => $senderName,
                'email' => $senderEmail);
     
    // Set recepient information
    $recepientEmail = $email;
     
     
    // Get Store ID    
    $store = Mage::app()->getStore()->getId();
 
    // Set variables that can be used in email template
   
    $vars = array();
    $vars['customerName'] = 'Branko';
    $vars['customerEmail'] = 'Ajzele';
             
    $translate  = Mage::getSingleton('core/translate');
 
    // Send Transactional Email
    Mage::getModel('core/email_template')
        ->sendTransactional($templateId, $sender, $recepientEmail, $recepientName, $vars, $storeId);
             
    $translate->setTranslateInline(true);
	}
	
	public function getemail($q){
		
		$sql = "select distinct email from sales_flat_quote_address where quote_id = $q";  
		 $result =  $this->read()->fetchOne($sql);
	}
	
}
