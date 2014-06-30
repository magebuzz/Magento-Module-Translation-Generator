<?php
/*
* Copyright (c) 2013 www.magebuzz.com 
*/

class Magebuzz_Featuredproducts_Block_Product_List_Homepage extends Magebuzz_Featuredproducts_Block_Product_List {
	const NUMBER_COLUMNS = 4;

	public function getColumnCount() {
		return self::NUMBER_COLUMNS;
	}

	protected function _getNumberFeaturedProducts() {
		return Mage::getStoreConfig('featured_products/homepage/number_products');	
	}

	protected function _getProductCollection() {
		$collection = parent::_getProductCollection();		
		$collection->getSelect()->order(new Zend_Db_Expr('RAND()'));
		$collection->getSelect()->limit($this->_getNumberFeaturedProducts());
		Mage::getModel('review/review')->appendSummary($collection);
		return $collection;
	}

	public function getBlockTitle() {
		$title = Mage::getStoreConfig('featured_products/homepage/blocktitle');
		return (empty($title)) ? "Featured Products" : $title;
	}
}