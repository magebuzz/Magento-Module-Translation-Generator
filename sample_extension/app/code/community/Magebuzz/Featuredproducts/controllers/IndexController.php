<?php
/*
* Copyright (c) 2013 www.magebuzz.com 
*/
class Magebuzz_Featuredproducts_IndexController extends Mage_Core_Controller_Front_Action {
	public function indexAction() {			
		$this->loadLayout();
		print_r($_SERVER);
		$this->renderLayout();
	}
}