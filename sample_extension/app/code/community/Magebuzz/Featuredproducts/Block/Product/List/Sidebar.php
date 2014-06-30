<?php
/*
* Copyright (c) 2013 www.magebuzz.com 
*/
class Magebuzz_Featuredproducts_Block_Product_List_Sidebar extends Magebuzz_Featuredproducts_Block_Product_List {
	protected function _getNumberFeaturedProducts() {
		return Mage::getStoreConfig('featured_products/sidebar/number_products');	
	}

	protected function _getProductCollection() {
		$collection = parent::_getProductCollection();		
		$collection->getSelect()->order(new Zend_Db_Expr('RAND()'));
		$collection->getSelect()->limit($this->_getNumberFeaturedProducts());
		return $collection;
	}

	public function getBlockTitle() {
		$title = Mage::getStoreConfig('featured_products/sidebar/blocktitle');
		return (empty($title)) ? "Featured Products" : $title;
	}
}