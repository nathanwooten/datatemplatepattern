<?php

use Site\{

	Registry\InputRegistry,
	Registry\OutputRegistry

};

if ( ! function_exists( 'dta' ) ) {
function dta()
{

	try {

		$container = dtaInput();
		$result = dtaApplication( $container );

	} catch ( Exception $e ) {

		return dtaHandle( $e, 1 );
	}

	return $result;

}
}

if ( ! function_exists( 'dtaInput' ) ) {
function dtaInput()
{

	return InputRegistry::getInstance();

}
}

if ( ! function_exists( 'dtaOutput' ) ) {
function dtaOutput()
{

	return OutputRegistry::getInstance();

}
}

if ( ! function_exists( 'dtaApplication' ) ) {
function dtaApplication( $container = null )
{

	try {
		dtaInitialize();
	} catch ( Exception $e ) {
		dtaHandle( $e, 1 );
	}

	$response = dtaIterate( $container );
	return $response;

}
}

if ( ! function_exists( 'dtaInitialize' ) ) {
function dtaInitialize()
{

	$defined = get_defined_functions();
	$user = $defined[ 'user' ];

	$prefix = __FUNCTION__;

	try {
		foreach ( $user as $function ) {
			if ( 0 === strpos( $function, $prefix ) ) {
				$function();
			}
		}
	} catch ( Exception $e ) {
		dtaHandle( $e, 1 );
	}

	return 1;

}
}

if ( ! function_exists( 'dtaInitializeRegistries' ) ) {
function dtaIntializeRegistries()
{

	$namespace = 'Builder' . BS . 'Registry' . BS;

	foreach ( [ $namespace . 'InputRegistry', $namespace . 'OutputRegistry' ] as $registry ) {
		$registry::getInstance();
	}

}
}

if ( ! function_exists( 'dtaIterate' ) ) {
function dtaIterate( $container = null )
{

	$container = dtaInput( $container );

	$route = '*';

	foreach ( $container[ $route ] as $cache => $callArray ) {

		$callback = $callArray[0];

		if ( isset( $callArray[1] ) ) {

			$args = $callArray[1];
			$args = dtaParseArgs( $args, dtaOutput() );
		} else {

			$args = [];
		}

		$response = dtaCall( $cache, $callback, $args );
	}

	return $response;

}
}

if ( ! function_exists( 'dtaParseArgs' ) ) {
function dtaParseArgs( $args, $container ) {

	foreach ( $args as $name => $arg ) {

		if ( is_array( $arg ) ) {
			$args[ $name ] = dtaParseArgs( $arg, $container );

		} else {

			if ( is_null( $arg ) && isset( $container[ $name ] ) ) {
				$args[ $name ] = $container[ $name ];
			}
		}
	}

	return $args;

}
}



if ( ! function_exists( 'dtaCall' ) ) {
function dtaCall( $name, $callback, array $args = [] )
{

	try {
		$result = $callback( ...array_values( $args ) );

	} catch ( Exception $e ) {
		handle( $e, 1 );
	}

	OutputRegistry::set( $name, $result );

	return 1;

}
}

if ( ! function_exists( '' ) ) {
function dtaUrl( $url = null, $filters = null )
{

	if ( ! isset( $url ) ) {
		$url = $_SERVER[ 'REQUEST_URI' ];
	}

	$url = parse_url( $url, PHP_URL_PATH );

	$url = dtaUrlFilter( $url, $filters );
	return $url;

}
}

if ( ! function_exists( '' ) ) {
function dtaUrlFilter( $url, $filters = null )
{

	if ( is_null( $filters ) ) {
		$filters = dtaUrlFilters();

		if ( is_null( $filters ) ) {
			return $url;
		}
	} elseif ( false == $filters ) {

		return $url;
	}

	if ( ! is_array( $filters ) ) {
		$filters = [ $filters ];
	}

	foreach ( $filters as $filter ) {

		$filter = 'dtaUrlFilter' . $filter;
		$url = $filter( $url );
	}

	return $url;

}
}

if ( ! function_exists( 'dtaUrlFilters' ) ) {
function dtaUrlFilters()
{

	return 'Homepage';

}
}

if ( ! function_exists( 'dtaUrlFilterHomepage' ) ) {
function dtaUrlFilterHomepage( $url )
{

	if ( '' === $url || '/' === $url ) {
		$url = 'homepage';
	}

	return $url;

}
}

if ( ! function_exists( 'dtaUrlFilterSiteIsSubDirectory' ) ) {
function dtaUrlFilterSiteIsSubDirectory( $url )
{

	global $subfolder;
	if ( ! isset( $subfolder ) ) {
		return $url;
	}

	$url = dtaMutateDown( $url, $subfolder, '/' );

	return $url;

}
}

if ( ! function_exists( 'dtaMutateUp' ) ) {
function dtaMutateUp( $mutate, $subfolder, $separator )
{

	$subfolder = trim( str_replace( [ '/', '\\' ], $separator, $subfolder ), $separator );

	$count = 0;
	while ( false !== strpos( $subfolder, $separator ) ) {

		$mutate = dirname( $mutate );

		$subfolder = substr( $subfolder, strpos( $subfolder, $separator ) );
	}

	$dir = $mutate;
	return $dir;

}
}

if ( ! function_exists( 'dtaMutateDown' ) ) {
function dtaMutateDown( $mutate, $subfolder, $separator ) {

	$dir = false;

	$mutate = trim( str_replace( [ '/', '\\' ], $separator, $mutate ), $separator );

	if ( ! $dir && '' === $mutate ) {
		$dir = $separator;
	} else {
		$mutate = $separator . $mutate;
	}

	if ( ! $dir && empty( $subfolder ) ) {
		$dir = $mutate;
	}

	if ( ! $dir ) {
		$subfolder = trim( str_replace( [ '/', '\\' ], $separator, $subfolder ), $separator );

		$mutate = $subfolder . $mutate;
		$dir = $mutate;
	}

	return $dir;

}
}

if ( ! function_exists( 'dtaDataFilePull' ) ) {
function dtaDataFilePull( $filename, $directory, $extension = '.txt' )
{

	$file = $directory . $filename . $extension;

	$contents = file_get_contents( $file );

	return $contents;

}
}

if ( ! function_exists( 'dtaTemplateResponse' ) ) {
function dtaTemplateResponse( $templates )
{

	if ( ! is_array( $templates ) ) {
		$templates = [ $templates ];
	}

	try {

		ob_start();

		foreach ( $templates as $name => $template ) {

			$template = dtaTemplateToString( $template );

			print $template;
		}

	} catch ( Exception $e ) {

		handle( $e, 1 );
	}

	$page = ob_get_clean();

	print $page;

	return $page;

}
}

if ( ! function_exists( 'dtaTemplateCompile' ) ) {
function dtaTemplateCompile( $name, $input, array $vars = [] )
{

	$templates = [];

	$input = dtaTemplateInput( $input );

	$file = dtaTemplateFile( $name );
	$file = dtaTemplatePut( $input, $file );

	$contents = dtaTemplateGrab( $file, $vars );

	return $contents;

}
}

if ( ! function_exists( 'dtaTemplateCompileArray' ) ) {
function dtaTemplateCompileArray( $templates = [], $vars = [] )
{

	try {

		foreach ( $templates as $name => $input ) {

			$templates[ $name ] = dtaTemplateCompile( $name, $input, $vars );
		}

		return $files;

	} catch ( Exception $e ) {

		handle( $e );
	}

	return $templates;

}
}

if ( ! function_exists( 'dtaTemplateGrab' ) ) {
function dtaTemplateGrab( $file, $vars = [] )
{

	extract( $vars );

	ob_start();
	include $file;			

	$contents = ob_get_clean();

	return $contents;

}
}

if ( ! function_exists( 'dtaTemplatePut' ) ) {
function dtaTemplatePut( $put, $file )
{

	file_put_contents( $file, $put );

	if ( file_exists( $file ) && is_readable( $file ) ) {
		return $file;
	}

	throw new Exception( sprintf( 'Unable to put file, %s', $file ) );

}
}

if ( ! function_exists( 'dtaTemplateFile' ) ) {
function dtaTemplateFile( $filename, $ext = '.php', $dir = 'compile' )
{

	if ( ! empty( $dir ) ) {
		$dir = trim( $dir, '/' ) . '/';
	}

	$filename = rtrim( $filename, '.php' );

	$file = TEMPLATESPATH . $dir . $filename . $ext;
	return $file;

}
}

if ( ! function_exists( 'dtaTemplateInput' ) ) {
function dtaTemplateInput( $input ) {

	$file = TEMPLATESPATH . $input . '.php';
	if ( file_exists( $file ) && is_readable( $file ) ) {
		$input = file_get_contents( $file );
	}

	return $input;

}
}

if ( ! function_exists( 'dtaTemplateToString' ) ) {
function dtaTemplateToString( $template )
{

	return (string) $template;

}
}

if ( ! function_exists( 'dtaDebug' ) ) {
function dtaDebug( $constant = 'DEBUG' )
{

	$debug = (bool) constant( $constant );
	return $debug;

}
}

if ( ! function_exists( 'dtaHandle' ) ) {
function dtaHandle( Exception $e, $do = null )
{

	if ( ! isset( $do ) ) {
		$do = dtaDebug();
	}

	switch ( $do ) {

		case true:
			throw $e;
			break;

		case false:
			return false;
			break;

	}

}
}
