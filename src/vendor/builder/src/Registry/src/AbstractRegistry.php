<?php

namespace Builder\Registry;

use ArrayAccess;

if ( ! class_exists( __NAMESPACE__ . BS . basename( __FILE__, '.php' ) ) ) {
class AbstractRegistry implements ArrayAccess
{

	public $container = [];

	public function set( $id, $item )
	{

		$this->container[ $id ] = $item;

	}

	public function get( $id )
	{

		if ( isset( $this->container[ $id ] ) ) {
			return $this->container[ $id ];
		}

	}

	public function has( $id )
	{

		return isset( $this->container[ $id ] );

	}

	public function remove( $id )
	{

		unset( $this->container[ $id ] );

	}

	public function all()
	{

		return $this->container;

	}

	public function offsetSet( $offset, $value )
	{

		$this->container[ $offset ] = $value;

	}

	public function offsetGet( $offset )
	{

		return isset( $this->container[ $offset ] ) ? $this->container[ $offset ] : null;

	}

	public function offsetUnset( $offset )
	{

		unset( $this->container[ $offset ] );

	}

	public function offsetExists( $offset )
	{

		return isset( $this->container[ $offset ] );

	}

}
}
