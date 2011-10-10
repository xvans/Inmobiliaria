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
            
            if ( is_array( $value ) ) {
            	
            	for ( $i = 0; $i < count( $this->fields ); $i++ ) {
            		
            		$this->_data[$this->fields[$i]] = $value[$this->fields[$i]];
            		
            	}
            	
            }
            
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
