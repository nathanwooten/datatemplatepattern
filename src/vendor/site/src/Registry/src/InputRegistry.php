<?php

namespace Site\Registry;

use Builder\{

	Registry\AbstractInputRegistry,
	Registry\AbstractRegistry

};

use Site\{

	Registry\InputRegistryContainer

};

if ( ! class_exists( __NAMESPACE__ . BS . basename( __FILE__, '.php' ) ) ) {
class InputRegistry extends AbstractInputRegistry
{

	public AbstractRegistry $registry;

	protected function __construct()
	{

		$this->registry = new InputRegistryContainer;

	}

}
}
