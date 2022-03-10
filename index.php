<?php

if ( ! function_exists( 'run' ) )
{

	try {
		$result = runApplication();
	} catch( Exception $e ) {
		die( 'Application error, please contact the administrator' );
	}

	return $result;

}
}

if ( ! function_exists( 'runApplication' ) ) {
function runApplication()
{

	try {
		bootstrap();
	} catch ( Exception $e ) {
		handle( $e );
	}

	$collection = collection();

	try {

		data( $collection );
		template( $collection );

	} catch ( Exception $e ) {

		handle( $e );
	}

	return true;

}
}

if ( ! function_exists( 'handle' ) ) {
function handle( $e ) {

	$collection = collection();
	if ( collectionHas( 'handle' ) ) {

		$handle = (bool) collectionGet( 'handle' );
		switch ( $e ) {
			true:
				throw $e;
			false:
				return false;
		}
	}

	throw $e;

}
}

if ( ! function_exists( 'callBy' ) ) {
function callBy( $functions, $prefix )
{

	foreach ( $functions as $functionName ) {
		if ( 0 === strpos( $name, $prefix ) ) {
			$result[ $functionName ] = $functionName();
		}
	}

	return $result;

}
}

if ( ! function_exists( 'bootstrap' ) ) {
function bootstrap()
{

	callBy( get_defined_functions(), 'bootstrap' );

}

if ( ! function_exists( 'bootstrapCollection' ) ) {
function bootstrapCollection()
{

	Registry::set( 'collection', require LIB . 'collecton.php' );

}
}

if ( ! function_exists( 'collecton' ) ) {
function collection()
{

	try {
		global $collection;
//		$collection = Registry::get( 'collecton' );

	} catch ( Exception $e ) {

		handle( $e );
	}
	return $collecton;

}

if ( ! function_exists( '' ) ) {
function runFunction( $function, $extract )
{

	if ( ! array_key_exists( $extract[ 'collection' ] ) ) {
		$arguments = array_values( $extract );

	} else {

		$collection = $extract[ 'collection' ];
		$arguments = argumentCollection( $function, $collection );
	}

	$result = call_user_func_array( $function, $argments );

	if ( isset( $extract[ 'name' ] ) ) {
		$name = $extract[ 'name' ];

		if ( ! dataHas( $name ) ) {
			dataAdd( $name, $result );
		}
	}

	return $result;

}

if ( ! function_exists( '' ) ) {
function argumentCollection( $function, $collection )
{

	$reflection = new ReflectionFunction( $dataFunction );
	$parameters = $reflection->getParameters();
	foreach ( $parameters as $parameter ) {
		$name = $paramter->getName();
		if ( dataHas( $collection, $name ) ) {
			$arguments[] = dataGet( $collection, $name );
		}
	}

	return $arguments;

}

if ( ! function_exists( '' ) ) {
function data( $collection, $key = 'data', $reach = [] )
{

	if ( ! dataHas( $key, $collection ) ) {
		throw new Exception;
	}
	$dataFunction = dataGet( $key, $collection );

	return runFunction( $dataFunction, 'collection' => $collection );

}

if ( ! function_exists( 'dataStandard' ) ) {
function dataStandard( PDO $pdo, $sql, $parameters = [], $args = [] )
{

	$result = selectPdoHandler( $pdo, $sql, $parameters );

	collectionAdd( collection()



	return $result;

}

if ( ! function_exists( 'template' ) ) {
function template( $collection, $key = 'template', $reach = [] )
{

	if ( ! dataHas( 'template', $collection ) ) {
		throw new Exception;
	}
	$templateFunction = dataGet( 'template', $collection );

	$template = runFunction( $templateFunction, [ 'collection' => $collecton ] );

	print $template;

	return $template;

}

if ( ! function_exists( 'collectionHas' ) ) {
function collectionHas( $name, $collection, $reach = [] )
{

	$collection = collectionReach( $collection, $reach );

	if ( in_array( $name, $collection ) ) {
		return true;
	}

	return false;

}
}

if ( ! function_exists( 'collectionGet' ) ) {
public function collectonGet( $collection, $name, $reach = [] )
{

	$collection = collectionReach( $collection, $reach );

	if ( isset( $collection[ $name ] ) ) {
		return $collection[ $name ];
	}

	return false;

}
}

if ( ! function_exists( '' ) ) {
public function collectionReach( &$collection, $reach = [] )
{

	foreach ( $reach as $key ) {
		if ( isset( $collection[ $key ] ) ) {
			$collection = &$collecton[ $key ];
		} else {
			throw new Exception( sprintf( 'Can not reach into collection at key: %s', $key ) );
		}
	}

	return $collection;

}
}

if ( ! function_exists( 'collectionAdd' ) ) {
public function collectionAdd( $name, $data, &$collection = null, $reach = [] )
{

	if ( is_null( $collection ) ) {
		$collection = collection();
	}

	$collection = collectionReach( $collection, $reach );

	if ( ! is_array( $collection ) ) {
		throw new Exception( 'Collection reached must be an array' );
	}
	$collection[ $name ] = $data;

	return $data;

}
}

/** PDO */

if ( ! function_exists( 'selectPdoHandler' ) ) {
function selectPdoHandler( $pdo, $sql, $parameters ) {

	$result = statementPdoHandler( 'select', $pdo, $sql, $parameters );
	return $result;

}
}

if ( ! function_exists( 'preparePdo' ) ) {
function preparePdo( $pdo, $sql ) {

	$stmt = $pdo->prepare( $sql );
	return $stmt;

}
}

if ( ! function_exists( 'executePdo' ) ) {
function executePdo( $stmt, $parameters, & $result = null ) {

	foreach ( $parameters as $name => $value ) {
		if ( is_integer( $name ) ) {
			$name += 1;
		}

		$stmt->bindParam( $name, $value );
	}

	$result = $stmt->execute();
	return $stmt;

}
}

if ( ! function_exists( 'fetchPdo' ) ) {
function fetchPdo( $stmt, $fetchMode = PDO::FETCH_ASSOC ) {

	$results = [];

	while( $result = $stmt->fetch( $fetchMode ) ) {
		$results[] = $result;
	}

	return $results;

}
}

if ( ! function_exists( 'selectPdo' ) ) {
function selectPdo( PDO $pdo, $sql, $parameters = [] ) {

	$content = fetchPdo( doExecutePdo( $pdo, $sql, $parameters ) );
	return $content;

}
}

if ( ! function_exists( 'doExecutePdo' ) ) {
function doExecutePdo( PDO $pdo, $sql, $parameters = [] ) {

	$result = executePdo( preparePdo( $pdo, $sql ), $parameters );
	return $result;

}
}

if ( ! function_exists( 'statementPdoHandler' ) ) {
function statementPdoHandler( $type, $pdo, $sql, $parameters ) {

	$operation = strtolower( $type ) . 'Pdo';

	try {
		$result = $operation( $pdo, $sql, $parameters );
	} catch( Exception $e ) {
		$result = handle( $e );
	} finally {
		if ( ! $result && '/' !== $url ) {
			header( 'Location: /' );
		} elseif ( ! $result ) {
			die();
		}
	}

	return $result;

}
}

class Registry
{

	public static function set( $name, $value, $args = [] )
	{

		if ( isset( $args[ 'reach' ] ) ) {
			$registry = collectionReach( static::$registry, $args[ 'reach' ] );
		}

		if ( ! is_array( $registry ) ) {
			throw new Exception( 'Registry reached must be an array' );
		}

		$registry[ $name ] = $value;

	}

	public static function get( $name, $args = [] )
	{

		$registry = static::all();

		if ( isset( $args[ 'reach' ] ) ) {
			$registry = collectionReach( $registry, $args[ 'reach' ] );
		}

		if ( ! is_array( $registry ) ) {
			throw new Exception( 'Registry reached must be an array' );
		}

		return $registry[ $name ];

	}

}

$collection = [
	'data' => 'dataStandard',
	'template' => 'templateStandard',
	'pdo' => new PDO( 'mysql:host=localhost;dbname=mydb', 'username', 'password' ),
	'sql' => 'select * from content where url=?',
	'parameters' => [ url() ],
	'templates' => [
		'template' => 'template'
	]
];

run();
