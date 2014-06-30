<?php
/*
* Copyright (c) 2013 www.magebuzz.com 
*/
class Magebuzz_Featuredproducts_Block_Product_List_Categorypage extends Magebuzz_Featuredproducts_Block_Product_List {
	const NUMBER_COLUMNS = 3;

	public function getColumnCount() {
		return self::NUMBER_COLUMNS;
	}

	protected function _getNumberFeaturedProducts() {
		return Mage::getStoreConfig('featured_products/categorypage/number_products');	
	}

	protected function _getProductCollection() {
		$collection = parent::_getProductCollection();
		$collection->addCategoryFilter($this->getLayer()->getCurrentCategory());
		$collection->getSelect()->order(new Zend_Db_Expr('RAND()'));
		$collection->getSelect()->limit($this->_getNumberFeaturedProducts());
		Mage::getModel('review/review')->appendSummary($collection);
		return $collection;
	}

	public function getBlockTitle() {
		$title = Mage::getStoreConfig('featured_products/categorypage/blocktitle');
		return (empty($title)) ? "Featured Products" : $title;
	}

}