<?php

$dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;
$msg = 'An unrecoverable error has occured, please contact the administrator, %s';

try {
	require_once $dir . 'require_once.php';
} catch ( Exception $e ) {
var_dump( $e->getMessage() );
	die( sprintf( $msg, 'required' ) );
}

try {
	run();
} catch ( Exception $e ) {

	die( sprintf( $msg, 'dta' ) );
}
