<?php

namespace Builder\Registry;

abstract class AbstractInputRegistry extends Registry {

	public AbstractRegistry $registry;

	public function __construct()
	{

		$this->registry = new AbstractRegistry;

	}

}
