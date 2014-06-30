<?php
/*
* Copyright (c) 2013 www.magebuzz.com 
*/
$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();                       
                             
$setup->addAttribute('catalog_product', 'magebuzz_featured_product', array(
	'group'				=> 'General',
	'attribute_set'		=> 'Default',
	'label'             => 'Is Featured Product',
	'type'              => 'int',
	'input'             => 'boolean',
	'default'           => '0',
	'backend'           => '',
	'frontend'          => '', 
	'source'            => '',
	'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
	'visible'           => true,
	'required'          => true,
	'user_defined'      => true,
	'searchable'        => false,
	'filterable'        => false,
	'comparable'        => false,
	'visible_on_front'  => false,
	'visible_in_advanced_search' => false,
	'unique'            => false
));

$installer->endSetup();
