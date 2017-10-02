<?php

class Alm_Orderprocess_Block_Adminhtml_Orderprocess_Grid extends Mage_Adminhtml_Block_Report_Shopcart_Abandoned_Grid {
  public function __construct()
  {
      parent::__construct();
      $this->setId('orderprocessGrid');
      $this->setDefaultSort('orderprocess_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
     $collection =  Mage::getResourceModel('reports/quote_collection');
     $filter = $this->getParam($this->getVarNameFilter(), array());
     if ($filter) {
     	$filter = base64_decode($filter);
     	parse_str(urldecode($filter), $data);
     }
     
     if (!empty($data)) {
     	$collection->prepareForAbandonedReport($this->_storeIds, $data);
     } else {
     	$collection->prepareForAbandonedReport($this->_storeIds);
     }
     
     $this->setCollection($collection);
     
     return parent::_prepareCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
  	$this->addColumn('entity_id', array(
  			'header'    =>Mage::helper('reports')->__('Quote Id'),
  			'index'     =>'entity_id',
  			'sortable'  =>false
  	));
  	$this->addColumn('customer_name', array(
  			'header'    =>Mage::helper('reports')->__('Customer Name'),
  			'index'     =>'customer_name',
  			'sortable'  =>false
  	));
  	
  	$this->addColumn('email', array(
  			'header'    =>Mage::helper('reports')->__('Email'),
  			'index'     =>'email',
  			'sortable'  =>false
  	));
  	
  	$this->addColumn('items_count', array(
  			'header'    =>Mage::helper('reports')->__('Number of Items'),
  			'width'     =>'80px',
  			'align'     =>'right',
  			'index'     =>'items_count',
  			'sortable'  =>false,
  			'type'      =>'number'
  	));
  	
  	$this->addColumn('items_qty', array(
  			'header'    =>Mage::helper('reports')->__('Quantity of Items'),
  			'width'     =>'80px',
  			'align'     =>'right',
  			'index'     =>'items_qty',
  			'sortable'  =>false,
  			'type'      =>'number'
  	));
  	$this->addColumn('ship_price', array(
  			'header'    =>Mage::helper('reports')->__('Shipping Price'),
  			'width'     =>'80px',
  			'align'     =>'right',
  			'index'     =>'ship_price',
  			'sortable'  =>false,
  			'type'      =>'number'
  	));
  	 $this->addColumn('status', array(
          'header'    => Mage::helper('reports')->__('Status'),
          'align'     => 'center',
          'width'     => '80px',
          'index'     => 'ship_flag',
          'type'      => 'options',
          'options'   => array(
              2 => 'Completed',
             1 => 'Pending',
          ),
      ));
  	
  	
  	
  	return parent::_prepareColumns();
  	 
  }


 public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getEntityId()));
  }

}
