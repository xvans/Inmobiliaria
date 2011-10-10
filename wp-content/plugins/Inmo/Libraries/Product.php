<?php

class Product {
	
	private $_data = array();
	
	public function __construct () {
		
		return true;
		
	}
	
    public function __set( $key, $value = null ) {
        
        if ( is_array( $key ) ) {
            
            $this->_data = $key;
            
        } else {
            
            $this->_data[$key] = $value;
            
        }
        
        return $this;
        
    }
    
    public function __get( $key ) {
        
        $return = ( empty( $this->_data[$key] ) ) ? '' : $this->_data[$key] ;
        
        return $return;
        
    }
    
    public function Clear_All () {
        
        $this->_data = array();
        
    }
    
    public function Clear ( $key ) {
        
        unset( $this->_data[$key] );
        
        return $this;
        
    }
    
}
