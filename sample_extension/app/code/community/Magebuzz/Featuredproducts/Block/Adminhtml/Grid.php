<?php
/*
* Copyright (c) 2013 www.magebuzz.com 
*/
class Magebuzz_Featuredproducts_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        //where is the controller
        $this->_controller = 'adminhtml_featuredproducts';
        $this->_blockGroup = 'featuredproducts';
        //text in the admin header
        $this->_headerText = 'Featured Products Management';
        parent::__construct();
        $this->removeButton('add');
    }
}