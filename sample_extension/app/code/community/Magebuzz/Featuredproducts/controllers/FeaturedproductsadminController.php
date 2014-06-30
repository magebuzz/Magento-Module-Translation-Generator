<?php
/*
* Copyright (c) 2013 www.magebuzz.com 
*/	
class Magebuzz_Featuredproducts_FeaturedproductsadminController extends Mage_Adminhtml_Controller_Action {
	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('catalog/featured_products');
	}

	public function indexAction () {
		$this->_initAction();
		$this->renderLayout();
	}

	public function massSetFeaturedAction() {    
        $productIds = $this->getRequest()->getParam('product');
        if (!is_array($productIds)) {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        } else {
            if (!empty($productIds)) {
                try {
		            Mage::getSingleton('catalog/product_action')
		                ->updateAttributes($productIds, array('magebuzz_featured_product' => 1), $storeId);
		            $this->_getSession()->addSuccess(
		                $this->__('Total of %d product(s) have been set as featured.', count($productIds))
		            );
                } catch (Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }
        $this->_redirect('*/*/index');
    }

	public function massUnsetFeaturedAction() {    
        $productIds = $this->getRequest()->getParam('product');
        if (!is_array($productIds)) {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        } else {
            if (!empty($productIds)) {
                try {
		            Mage::getSingleton('catalog/product_action')
		                ->updateAttributes($productIds, array('magebuzz_featured_product' => 0), $storeId);
		            $this->_getSession()->addSuccess(
		                $this->__('Total of %d record(s) have been unset as featured.', count($productIds))
		            );
                } catch (Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }
        $this->_redirect('*/*/index');
    }

}
