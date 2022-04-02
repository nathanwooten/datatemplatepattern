<?php

namespace Site\Registry;

use Builder\{

	Registry\AbstractRegistry

};

if ( ! class_exists( 'AbstractInputRegistry' ) ) {
class InputRegistryContainer extends AbstractRegistry
{

	public $container = [

		/** Matches the homepage */

		'/' => [

			'content' => [
				'dtaDataFilePull',
				[
					'url' => 'homepage',
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
		],

		/** Matches any title */

		'#/.*?#' => [

			'url' => [
				'dtaUrl'
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
		],

		/** No matches fallback */

		'*' => [

			'content' => [
				'dtaDataFilePull',
				[
					'url' => 'homepage',
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
