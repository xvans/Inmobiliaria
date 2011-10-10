<?php

class db {
	
	public $db_id;
	
	public $num_queries = '0';
	
	private $data = array();
	
	private $in_transaction = '0';
	
	private $query_result;
	
	private $row = array();
	
	private $rowset = array();
	
	private $close = FALSE;
	
	public function __construct ( $sql_connect = array(), $persistency = TRUE, $close = FALSE ) {
		
		if (
			empty( $sql_connect ) or
			empty( $sql_connect['sql_server'] ) or
			empty( $sql_connect['sql_username'] ) or
			empty( $sql_connect['sql_password'] ) or
			empty( $sql_connect['sql_db'] )
			) {
			
			return FALSE;
			
		}
		
		$this->close = $close;
		
		return $this->sql_connect( $sql_connect, $persistency );
		
	}
	
	public function __destruct() {
		
		if ( $this->close === TRUE ) {
			
			$this->sql_close();
			
		}
		
	}
	
	public function sql_connect( $sql_connect = array(), $persistency = TRUE ) {
		
		if (
			empty( $sql_connect ) or
			empty( $sql_connect['sql_server'] ) or
			empty( $sql_connect['sql_username'] ) or
			empty( $sql_connect['sql_password'] ) or
			empty( $sql_connect['sql_db'] )
			) {
			
			return FALSE;
			
		}
		
		$this->data['sql_server'] 		= $sql_connect['sql_server'];
		$this->data['sql_username'] 	= $sql_connect['sql_username'];
		$this->data['sql_password'] 	= $sql_connect['sql_password'];
		$this->data['sql_db'] 			= $sql_connect['sql_db'];
		$this->data['persistency'] 		= $persistency;
		
		$this->db_id = ( $this->data['persistency'] === TRUE ) ? mysql_connect( $this->data['sql_server'] . ':3066', $this->data['sql_username'], $this->data['sql_password'] ) : mysql_connect( $this->data['sql_server'], $this->data['sql_username'], $this->data['sql_password'] ) ;
		
		if ( $this->db_id ) {
			
			if ( ! empty( $this->data['sql_db'] ) ) {
				
				$db_select = mysql_select_db( $this->data['sql_db'] );
				
				if ( ! $db_select ) {
					
					mysql_close( $this->db_id );
					$this->db_id = $db_select;
					
				}
				
			}
			
			return $this->db_id;
			
		}
		
		return FALSE;
		
	}
	
	public function sql_close () {
		
		if ( $this->db_id ) {
			
			if ( $this->in_transaction ) {
				
				mysql_query("COMMIT", $this->db_id);
				
			}
			
			return mysql_close( $this->db_id );
			
		} else {
			
			return FALSE;
			
		}
		
	}
	
	public function sql_query ( $query = "" , $transaction = FALSE ) {
		
		unset( $this->query_result );
		
		if( $query != "" ) {
			
			$this->num_queries++;
			
			if( $transaction == BEGIN_TRANSACTION && !$this->in_transaction ) {
				
				$result = mysql_query( "BEGIN" , $this->db_id );
				
				if( !$result ) { return false; }
				
				$this->in_transaction = TRUE;
				
			}
			
			$this->query_result = mysql_query( $query , $this->db_id );
			
		} else {
			
			if( $transaction == END_TRANSACTION && $this->in_transaction ) {
				
				$result = mysql_query( "COMMIT" , $this->db_id );
				
			}
			
		}
		
		if( $this->query_result ) {
			
			unset( $this->row[$this->query_result] );
			unset( $this->rowset[$this->query_result] );
			
			if( $transaction == END_TRANSACTION && $this->in_transaction ) {
				
				$this->in_transaction = FALSE;
				
				if ( !mysql_query("COMMIT" , $this->db_id ) ) {
					
					mysql_query( "ROLLBACK" , $this->db_id );
					return false;
					
				}
			}
			
			return $this->query_result;
			
		}else{
			
			if( $this->in_transaction ) {
				
				mysql_query( "ROLLBACK" , $this->db_id );
				$this->in_transaction = FALSE;
				
			}
			
			return false;
			
		}
		
	}
	
	public function sql_numrows( $query_id = 0 ) {
		
		if( !$query_id ) {
			
			$query_id = $this->query_result;
			
		}
		
		return ( $query_id ) ? mysql_num_rows( $query_id ) : false;
		
	}
	
	public function sql_affectedrows() {
		
		return ( $this->db_id ) ? mysql_affected_rows( $this->db_id ) : false;
		
	}
	
	public function sql_numfields( $query_id = 0 ) {
		
		if( !$query_id ) {
			
			$query_id = $this->query_result;
			
		}
		
		return ( $query_id ) ? mysql_num_fields( $query_id ) : false;
		
	}
	
	public function sql_fieldname( $offset , $query_id = 0) {
		
		if( !$query_id ) {
			
			$query_id = $this->query_result;
			
		}
		
		return ( $query_id ) ? mysql_field_name( $query_id , $offset ) : false;
		
	}
	
	public function sql_fieldtype( $offset , $query_id = 0 ) {
		
		if( !$query_id ) {
			
			$query_id = $this->query_result;
			
		}
		
		return ( $query_id ) ? mysql_field_type( $query_id , $offset ) : false;
		
	}
	
	public function sql_fetchrow( $query_id = 0 ) {
		
		if( !$query_id ) {
			
			$query_id = $this->query_result;
			
		}
		
		if( $query_id ) {
			
			@$this->row[$query_id] = @mysql_fetch_array( $query_id , MYSQL_ASSOC );
			return @$this->row[$query_id];
			
		} else {
			
			return false;
			
		}
		
	}
	
	public function sql_fetchrowset( $query_id = 0 ) {
		
		if( !$query_id ) {
			
			$query_id = $this->query_result;
			
		}
		
		if( $query_id ){
			
			unset( $this->rowset[$query_id] );
			unset( $this->row[$query_id] );
			
			while( @$this->rowset[$query_id] = mysql_fetch_array( $query_id , MYSQL_ASSOC ) ) {
				
				$result[] = @$this->rowset[$query_id];
				
			}
			
			return $result;
		
		} else {
			
			return false;
		
		}
		
	}
	
	public function sql_fetchfield( $field , $rownum = -1 , $query_id = 0 ){
		
		if( !$query_id ){
			
			$query_id = $this->query_result;
			
		}
		
		if( $query_id ){
			
			if( $rownum > -1 ){
				
				$result = mysql_result( $query_id , $rownum , $field );
			
			}else{
				
				if( empty( $this->row[$query_id] ) && empty( $this->rowset[$query_id] ) ){
					
					if( $this->sql_fetchrow() ) {
						
						$result = $this->row[$query_id][$field];
						
					}
					
				}else{
					
					if( $this->rowset[$query_id] ) {
						
						$result = $this->rowset[$query_id][$field];
						
					}else if( $this->row[$query_id] ) {
						
						$result = $this->row[$query_id][$field];
						
					}
					
				}
				
			}
			
			return $result;
			
		} else {
			
			return false;
			
		}
		
	}
	
	public function sql_rowseek(  $rownum , $query_id = 0 ){
		
		if( !$query_id ){ $query_id = $this->query_result; }
		
		return ( $query_id ) ? mysql_data_seek( $query_id , $rownum ) : false;
		
	}
	
	public function sql_nextid(){
		
		return ( $this->db_id ) ? mysql_insert_id( $this->db_id ) : false;
		
	}
	
	public function sql_freeresult( $query_id = 0 ){
		
		if( !$query_id ){
			
			$query_id = $this->query_result;
			
		}
		
		if ( $query_id ){
			
			unset( $this->row[$query_id] );
			unset( $this->rowset[$query_id] );
			@mysql_free_result( $query_id );
			
			return true;
			
		} else {
			
			return false;
			
		}
		
	}
	
	public function sql_error(){
		
		if ( ! is_resource( $this->db_id ) ) {
			
			return FALSE;
			
		}
		
		$result['message'] = mysql_error( $this->db_id );
		$result['code'] = mysql_errno( $this->db_id );
		
		return $result;
	
	}
	
	public function sql_escape( $var ) {
		
		if ( !$this->db_id ) {
			
			return @mysql_real_escape_string( $var );
			
		}
	
		return @mysql_real_escape_string( $var , $this->db_id );
		
	}
	
	public function sql_server_info() {
		
		return 'MySQL ' . @mysql_get_server_info( $this->db_id );
		
	}
	
}
