<?php

function dtaGetPath( $start, $finishFile )
{

	$msg = 'Unable to locate directory, %s';

	if ( is_file( $start ) ) {
		$dir = dirname( $start ) . DIRECTORY_SEPARATOR;
	} else {
		$dir = $start . DIRECTORY_SEPARATOR;
	}

	$file = $dir . $finishFile;

	while ( ! is_readable( $file ) ) {

		$before = $dir;

		$dir = dirname( $dir );
		$file = $dir . DIRECTORY_SEPARATOR . $finishFile;

		if ( $dir === $before ) {
			throw new Exception( sprintf( $msg, 'reached root' ) );
		}
	}

	$dir .= DIRECTORY_SEPARATOR;

	return $dir;

}

$path = dtaGetPath( __DIR__, 'projectrootflag.txt' );

require_once $path . 'require_once.php';
