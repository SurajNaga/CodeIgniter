<?php
class Alm_Orderprocess_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/orderprocess?id=15 
    	 *  or
    	 * http://site.com/orderprocess/id/15 	
    	 */
    	/* 
		$orderprocess_id = $this->getRequest()->getParam('id');

  		if($orderprocess_id != null && $orderprocess_id != '')	{
			$orderprocess = Mage::getModel('orderprocess/orderprocess')->load($orderprocess_id)->getData();
		} else {
			$orderprocess = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($orderprocess == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$orderprocessTable = $resource->getTableName('orderprocess');
			
			$select = $read->select()
			   ->from($orderprocessTable,array('orderprocess_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$orderprocess = $read->fetchRow($select);
		}
		Mage::register('orderprocess', $orderprocess);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}