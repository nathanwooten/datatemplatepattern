<?php

function runApplication()
{

	try {
		bootstrap();
	} catch ( Exception $e ) {
		handle( $e );
	}

	$collection = Registry::get( 'collecton' );

	try {

		data( $collection );
		template( $collection );

	} catch ( Exception $e ) {

		handle( $e );
	}

	return true;

}

function handle( $e ) {

	throw $e;

}

function bootstrap()
{

	foreach ( get_defined_functions() as $name ) {
		if ( 0 === strpos( $name, 'bootstrap' ) ) {
			$name();
		}
	}

}

function bootstrapCollection()
{

	Registry::set( 'collection', require LIB . 'collecton.php' );

}

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

function data( $collection )
{

	if ( ! dataHas( 'data', $collection ) ) {
		throw new Exception;
	}
	$dataFunction = dataGet( 'data', $collection );

	return runFunction( $dataFunction, 'collection' => $collection );

}

function template( $collection )
{

	if ( ! dataHas( 'template', $collection ) ) {
		throw new Exception;
	}
	$templateFunction = dataGet( 'template', $collection );

	$template = runFunction( $templateFunction, [ 'collection' => $collecton ] );

	print $template;

	return $template;

}

function dataHas( $name, $collection )
{

	if ( in_array( $name, $collection ) ) {
		return true;
	}

	return false;

}

public function dataGet( $collection, $name )
{

	return $collection[ $name ];

}

public function dataAdd( $name, $data, $collection )
{

	return $collection[ $name ] = $data;

}

/**
**/

function dataStandard( PDO $pdo, $sql, $parameters = [], $args = [] )
{

	$result = selectPdoHandler( $pdo, $sql, $parameters );
	return $result;

}

/** Settings */

$collection = [
	'data' => 'dataStandard',
	'template' => 'templateStandard'
];

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
