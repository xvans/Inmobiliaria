<?php
/*
Plugin Name: Inmo
Description: Sistema de Inmobiliaria
Author: JL Design
Version: 1.0
Author URI: http://www.jldesign.com.mx/
*/

require_once( 'Libraries/db.php' );
require_once( 'Libraries/Inmo.php' );
require_once( 'Libraries/Product.php' );
require_once( 'Libraries/Product_Casa.php' );

$mysql = array();

$mysql['sql_server'] 					= 'localhost';
$mysql['sql_username'] 					= 'xvans';
$mysql['sql_password'] 					= '@miguell';
$mysql['sql_db'] 						= 'wp';

$db 	= new db( $mysql, false, true );
$inmo 	= new Inmo();
$inmo->db = $db;

$filter = array(
	'oper_id' 				=> '1',
	'attr_orientacion' 		=> 'N',
	);

$inmo->Filter( $filter );
$inmo->Search();