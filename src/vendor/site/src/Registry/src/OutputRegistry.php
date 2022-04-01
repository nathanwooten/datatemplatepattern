<?php

namespace Site\Registry;

use Builder\{

	Registry\AbstractOutputRegistry,
	Registry\AbstractRegistry

};

use Site\{

	Registry\InputRegistryContainer

};

if ( ! class_exists( __NAMESPACE__ . BS . basename( __FILE__, '.php' ) ) ) {
class OutputRegistry extends AbstractOutputRegistry
{

	public AbstractRegistry $registry;

	protected function __construct()
	{

		$this->registry = new AbstractRegistry;

	}

}
}
