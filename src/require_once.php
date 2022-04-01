<?php

$dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

if ( ! defined( 'NATHANWOOTEN' ) ) define( 'NATHANWOOTEN', 1 );

$localhost = 'dev.localhost';
$debug = null;
$siteSubDirectory = '';

if ( ! defined( 'DEBUG' ) ) define( 'DEBUG', ! is_null( $debug ) ? (bool) $debug : $localhost === $_SERVER[ 'SERVER_NAME' ] );

if ( ! defined( 'DS' ) ) define( 'DS', DIRECTORY_SEPARATOR );
if ( ! defined( 'BS' ) ) define( 'BS', '\\' );
if ( ! defined( 'FS' ) ) define( 'FS', '/' );

if ( ! defined( 'ROOTPATH' ) ) define( 'ROOTPATH', dirname( __FILE__ ) . DS );

if ( ! defined( 'SITEPATH' ) ) define( 'SITEPATH', ROOTPATH . 'vendor' . DS . 'site' . DS . 'src' . DS );
if ( ! defined( 'TEMPLATESPATH' ) ) define( 'TEMPLATESPATH', SITEPATH . 'templates' . DS );
if ( ! defined( 'WRITEPATH' ) ) define( 'WRITEPATH', SITEPATH . 'write' . DS );

if ( ! defined( 'BUILDERPATH' ) ) define( 'BUILDERPATH', ROOTPATH . 'vendor' . DS . 'builder' . DS . 'src' . DS );
if ( ! defined( 'VENDORPATH' ) ) define( 'VENDORPATH', ROOTPATH. 'vendor' . DS . 'dependency' . DS );

$vendors = ROOTPATH . 'vendor' . DS . 'vendors.php';
if ( is_readable( $vendors ) ) {
	require_once $vendors;
}

return 1;
