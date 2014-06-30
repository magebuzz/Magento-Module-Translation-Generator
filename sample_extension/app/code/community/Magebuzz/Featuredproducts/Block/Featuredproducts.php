<?php
/*
* Copyright (c) 2013 www.magebuzz.com 
*/

class Magebuzz_Featuredproducts_Block_Featuredproducts extends Magebuzz_Featuredproducts_Block_Product_List {
	const NUMBER_COLUMNS = 4;
	const NUMBER_PRODUCTS = 4;
	const DEFAULT_TITLE = "Featured Products";

	public function getColumnCount() {
		$columnCount = $this->getData('columnCount');
		return is_null($columnCount) ? self::NUMBER_COLUMNS : $productCount;
	}

	public function getBlockTitle() {
		$title = $this->getData('blockTitle');
		return (is_null($title)) ? self::DEFAULT_TITLE : $title;
	}

	protected function _getNumberFeaturedProducts() {
		$productCount = $this->getData('productCount');
		return is_null($productCount) ? self::NUMBER_PRODUCTS : $productCount;
	}

	protected function _getProductCollection() {
		$collection = parent::_getProductCollection();		
		$collection->getSelect()->order(new Zend_Db_Expr('RAND()'));
		$collection->getSelect()->limit($this->_getNumberFeaturedProducts());
		Mage::getModel('review/review')->appendSummary($collection);
		return $collection;
	}

}