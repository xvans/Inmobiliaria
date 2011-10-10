<?php

class Product_Casa extends Product {
	
	public $product_id = null;
	
	public $fields = array(
		'product_id',
		'type_id',
		'type_name',
		'oper_id',
		'oper_name',
		'attr_orientacion',
		'attr_construccion_m2',
		'attr_terreno_m2',
		);
	
	public function __construct ( $product_id = null ) {
		
		$this->product_id = $product_id;
		return true;
		
	}
	
	private function __Set_Product () {
		
		$this->product_id;
		
	}
	
	private function __Save_Product () {
		
		$this->product_id;
		
	}

}
