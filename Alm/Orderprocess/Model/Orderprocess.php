<?php

class Alm_Orderprocess_Model_Orderprocess extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('orderprocess/orderprocess');
    }
     public function write (){
    	return  $writeConnection = Mage::getSingleton('core/resource')->getConnection('core_write');
    }
      public function updateShipping($data){
    	if($data['status']=1){
    	$price = $data['ship_price'];
    	$id = $data['quote_id'];
		$status=$data['status'];
		
		$sql = "update sales_flat_quote set ship_flag=2,ship_price=$price where entity_id = $id";
		
		$this->write()->query($sql);    		
    		 
    	}
		
    }
	public function deleteShipping($id)
	{
			$sql="delete  from sales_flat_quote where entity_id=$id";
			$this->write()->query($sql);   
			
	}
}
