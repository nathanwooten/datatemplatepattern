<?php

namespace Builder\Registry;

use ArrayAccess;

if ( ! class_exists( 'Registry' ) ) {
class Registry implements ArrayAccess
{

	public AbstractRegistry $registry;
	public static $instance;

	private function __construct()
	{

		static::$registry = new AbstractRegistry;

	}

	public static function set( $id, $item )
	{

		$instance = static::getInstance();

		return $instance->set( $id, $item );

	}

	public static function get( $id )
	{

		$instance = static::getInstance();

		return $instance->get( $id );

	}

	public static function has( $id )
	{

		$instance = static::getInstance();

		return $instance->has( $id );

	}

	public static function remove( $id )
	{

		$instance = static::getInstance();

		return $instance->remove( $id );

	}

	public static function all()
	{

		$instance = static::getInstance();

		return static::$instance->all();

	}

	public function offsetSet( $offset, $value )
	{

		return static::set( $offset, $value );

	}

	public function offsetGet( $offset )
	{

		return static::get( $offset );

	}

	public function offsetUnset( $offset )
	{

		return static::remove( $offset );

	}

	public function offsetExists( $offset )
	{

		return static::has( $offset );

	}

	public static function getInstance()
	{

		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		$instance = static::$instance->registry;
		return $instance;

	}

}
}
