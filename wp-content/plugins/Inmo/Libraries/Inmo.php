<?php

class Inmo {
	
	const PRODUCT_CASA = 1;
	const PRODUCT_CONJU = 2;
	const PRODUCT_RESID = 3;
	const PRODUCT_DEPTO = 4;
	const PRODUCT_CONDO = 5;
	const PRODUCT_LOCAL = 6;
	const PRODUCT_OFICI = 7;
	const PRODUCT_BODEG_IND = 8;
	const PRODUCT_BODEG_COM = 9;
	const PRODUCT_TERRE_HAB = 10;
	const PRODUCT_TERRE_IND = 11;
	const PRODUCT_TERRE_COM = 12;
	
	public $db;
	
	public $order = 'ASC';
	
	public $filters = array();
	
	public $products = array();
	
	public function __construct () {
		
		return true;
		
	}
	
	public function Filter ( $filters = array() ) {
		
		if ( ! is_array( $filters ) && count( $filters ) === 0 ) {
			
			$this->filters = array();
			return false;
			
		}
		
		foreach ( $filters as $key => $value ) {
			
			if ( empty( $value ) ) {
				continue;
			}
			
			$this->filters[ strip_tags( $key ) ] = strip_tags( $value );
			
		}
		
		$this->filters;
		
	}
	
	public function Search () {
		
		$sql_extend = null;
		
		foreach ( $this->filters as $key => $value ) {
			
			$sql_extend .= '
				AND ' . $this->db->sql_escape( $key ) . ' = \'' . $this->db->sql_escape( $value ) . '\'
				';
			
		}
		
		$sql_order .= '
			ORDER BY ' . 'P.product_id' . ' ' . $this->order . '
			';
		
		$sql = '
			SELECT *
			FROM inmo_product P, inmo_product_attr P_ATTR, inmo_product_type P_TYPE, inmo_product_oper P_OPER
			WHERE P_ATTR.product_id = P.product_id
				AND P_TYPE.type_id = P.product_type
				AND P_OPER.oper_id = P.product_oper
				' . $sql_extend . '
				' . $sql_order . '
			';
		
		echo $sql;
		
		if ( ! ( $result = $this->db->sql_query( $sql ) ) ) {
			
			print_r( $this->db->sql_error() );
			
		}
		
		if ( $this->db->sql_numrows( $result ) <> 0 ) {
			
			while ( $row = $this->db->sql_fetchrow( $result ) ) {
				
				$this->products[] = $this->Load_Product( $row );
				
			}
			
			for ( $i = 0; $i < count( $this->products ); $i++ ) {
				
				print_r( $this->products[$i] );
				
			}
			
		} else {
			
			echo 'No se han encontrado productos';
			
		}
		
		
	}
	
	public function Load_Product ( $data ) {
		$obj = null;
		
		switch ( $data['product_type'] ) {
			case self::PRODUCT_CASA:
				$obj = new Product_Casa( $data['product_id'] );
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_CONJU:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_RESID:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_DEPTO:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_CONDO:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_LOCAL:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_OFICI:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_BODEG_IND:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_BODEG_COM:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_TERRE_HAB:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_TERRE_IND:
				$obj = new Product_Casa();
				$obj->product = $data;
				return $obj;
			break;
			case self::PRODUCT_TERRE_COM:
				$obj = new Product_Casa();
				$obj->product = $data['product_id'];
				return $obj;
			break;
		}
		
		return false;
		
	}
	
}


















