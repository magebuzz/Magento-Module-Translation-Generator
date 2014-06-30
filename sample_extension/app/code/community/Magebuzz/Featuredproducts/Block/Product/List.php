<?php
/*
* Copyright (c) 2013 www.magebuzz.com 
*/
class Magebuzz_Featuredproducts_Block_Product_List extends Mage_Catalog_Block_Product_List {
	protected function _getProductCollection() {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->addAttributeToFilter('magebuzz_featured_product','1');
        $collection->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
			->addMinimalPrice()
			->addFinalPrice()
			->addTaxPercents();           
		Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
		Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
		
		return $collection;
	}
}