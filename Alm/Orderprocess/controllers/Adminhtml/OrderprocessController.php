<?php

class Alm_Orderprocess_Adminhtml_OrderprocessController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('orderprocess/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		
		
				$id     = $this->getRequest()->getParam('id');
		$model = Mage::getModel("sales/quote")->getCollection()
						->addFieldToFilter("entity_id",$id)
						//->addFieldToFilter("ship_flag",0)
						->getData();
						
		foreach ($model as $m){
			
			$mid = $m['entity_id'];
			$ship_price = $m['ship_price'];
			$shipping_status=$m['ship_flag'];
			
			$dataCollection = array("quote_id"=>$mid,"ship_price"=>$ship_price,'shipping_status'=>$shipping_status);
			 
		}
		
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('orderprocess_data', $dataCollection);

			$this->loadLayout();
			$this->_setActiveMenu('orderprocess/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('orderprocess/adminhtml_orderprocess_edit'))
				->_addLeft($this->getLayout()->createBlock('orderprocess/adminhtml_orderprocess_edit_tabs'));

			$this->renderLayout();
		
			}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
		$q = $data['quote_id']; 
			$quote =Mage::getResourceModel('reports/quote_collection')->addFieldToFilter("entity_id",$q);
			foreach ($quote as $c){			
					
					$email = $c->getCustomerEmail();
			}
			
		
			
			$model = Mage::getModel('orderprocess/orderprocess')->updateShipping($data);
			
			try {
				
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('orderprocess')->__('Item was successfully saved'));
				Mage::getModel('alm_checkout/checkout')->aftershipment($email);
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('orderprocess')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		
		
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$id	   = $this->getRequest()->getParam('id');
				$model = Mage::getModel('orderprocess/orderprocess')->deleteShipping($id);
				 
				//$model->setId($this->getRequest()->getParam('id'))
				//	->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $orderprocessIds = $this->getRequest()->getParam('orderprocess');
        if(!is_array($orderprocessIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($orderprocessIds as $orderprocessId) {
                    $orderprocess = Mage::getModel('orderprocess/orderprocess')->load($orderprocessId);
                    $orderprocess->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($orderprocessIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $orderprocessIds = $this->getRequest()->getParam('orderprocess');
        if(!is_array($orderprocessIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($orderprocessIds as $orderprocessId) {
                    $orderprocess = Mage::getSingleton('orderprocess/orderprocess')
                        ->load($orderprocessId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($orderprocessIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    public function exportCsvAction()
    {
        $fileName   = 'orderprocess.csv';
        $content    = $this->getLayout()->createBlock('orderprocess/adminhtml_orderprocess_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'orderprocess.xml';
        $content    = $this->getLayout()->createBlock('orderprocess/adminhtml_orderprocess_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}
