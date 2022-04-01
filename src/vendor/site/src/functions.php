<?php

if ( ! function_exists( 'run' ) ) {
function run()
{

	try {
		$result = dta();

	} catch ( Exception $e ) {

		try {
			throw new Exception( 'An unrecoverable error has occurred, please contact the administrator', 0, $e );

		} catch ( Exception $e ) {

			print $e->getMessage() . ' :: ' . $e->getPrevious()->getMessage();
		}
	}

	return 1;

}
}
