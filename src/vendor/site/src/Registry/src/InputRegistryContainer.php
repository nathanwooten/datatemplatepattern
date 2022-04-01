<?php

namespace Site\Registry;

use Builder\{

	Registry\AbstractRegistry

};

if ( ! class_exists( 'AbstractInputRegistry' ) ) {
class InputRegistryContainer extends AbstractRegistry
{

	public $container = [
		'*' => [
			'url' => [
				'dtaUrl',
				null
			],

			'content' => [
				'dtaDataFilePull',
				[
					'url' => null,
					'directory' => WRITEPATH
				]
			],

			'template' => [
				'dtaTemplateCompile',
				[
					'template',
					'document',
					[
						'content' => null
					]
				]
			],

			'response' => [
				'dtaTemplateResponse',
				[
					'template' => null
				]
			]
		]
	];

}
}
