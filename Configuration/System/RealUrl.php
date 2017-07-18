<?php

/*******************************************************************
 *  Copyright notice
 *
 *  (c] 2017 Pavel Leonidov <pavel.leonidov@mosaiq.com>, MOSAIQ GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as
 *  published by the Free Software Foundation; either version 2 of
 *  the License, or (at your option] any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ******************************************************************/

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// ===================================================================
// Real-URL configuration
// ===================================================================

$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'].= ',tx_realurl_pathsegment';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT'] = [
	'init' => [
		'enableCHashCache'     => TRUE,
		'appendMissingSlash'   => 'ifNotFile',
		'enableUrlDecodeCache' => 1,
		'enableUrlEncodeCache' => 1,
		'respectSimulateStaticURLs' => 0,
		'postVarSet_failureMode' => '',
		//'emptyUrlReturnValue'  => '/',
	],
	'redirects' => [
	],
	'pagePath' => [
		'type'                => 'user',
		'userFunc'            => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
		'spaceCharacter'      => '-',
		'languageGetVar'      => 'L',
		'segTitleFieldList'   => 'tx_realurl_pathsegment,nav_title,title',
		'disablePathCache'    => 0,
		'autoUpdatePathCache' => 1,
		'expireDays'          => 3,
		'rootpage_id'         => 1,
	],

	'fileName' => [
		'index' => [
			'sitemap.xml' => [
				'keyValues' => [
					'type' => 841132,
				],
			],
			'robots.txt' => [
				'keyValues' => [
					'type' => 841133,
				],
			],

			'newsletter.html' => [
				'keyValues' => [
					'type' => 1296728024,
				],
			],
		],
	],

	'preVars' => [
		[
			'GETvar' => 'L',
			'valueMap' => [
				'en' => '1',
			],
			'noMatch' => 'bypass',
		],
		[
			'GETvar' => 'no_cache',
			'valueMap' => [
				'nc' => 1,
			],
			'noMatch' => 'bypass',
		],
		[
			'GETvar' => 'no_cache',
			'valueMap' => [
				'nc' => 1,
			],
			'noMatch' => 'bypass',
		],

	],
	'fixedPostVars' => [
		'newsDetailConfiguration' => [
			[
				'GETvar' => 'tx_news_pi1[action]',
				'noMatch' => 'bypass',
				'valueMap' => [
					'detail' => '',
				],
			],
			[
				'GETvar' => 'tx_news_pi1[controller]',
				'noMatch' => 'bypass',
				'valueMap' => [
					'News' => '',
				],
			],
			[
				'GETvar' => 'tx_news_pi1[news]',
				'lookUpTable' => [
					'table' => 'tx_news_domain_model_news',
					'id_field' => 'uid',
					'alias_field' => 'title',
					'addWhereClause' => ' AND NOT deleted',
					'useUniqueCache' => 1,
					'useUniqueCache_conf' => [
						'strtolower' => 1,
						'spaceCharacter' => '-'
					],
					'languageGetVar' => 'L',
					'languageExceptionUids' => '',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'autoUpdate' => 1,
					'expireDays' => 180,
				]
			]
		],
		'newsCategoryConfiguration' => [
			[
				'GETvar' => 'tx_news_pi1[overwriteDemand][categories]',
				'lookUpTable' => [
					'table' => 'sys_category',
					'id_field' => 'uid',
					'alias_field' => 'title',
					'addWhereClause' => ' AND NOT deleted',
					'useUniqueCache' => 1,
					'useUniqueCache_conf' => [
						'strtolower' => 1,
						'spaceCharacter' => '-'
					],
					'languageGetVar' => 'L',
					'languageExceptionUids' => '',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'autoUpdate' => 1,
					'expireDays' => 180,

				],
				'noMatch' => 'bypass',
			]
		],
		'newsTagConfiguration' => [
			[
				'GETvar' => 'tx_news_pi1[overwriteDemand][tags]',
				'lookUpTable' => [
					'table' => 'tx_news_domain_model_tag',
					'id_field' => 'uid',
					'alias_field' => 'title',
					'addWhereClause' => ' AND NOT deleted',
					'useUniqueCache' => 1,
					'useUniqueCache_conf' => [
						'strtolower' => 1,
						'spaceCharacter' => '-'
					]
				],
				'noMatch' => 'bypass'
			]
		],
		'cal' => [
			[
				'GETvar' => 'tx_cal_controller[type]',
				'valueMap' => [
					'detail' =>  'tx_cal_phpicalendar'
				],
				'noMatch' => 'bypass'
			],

			[
				'GETvar' => 'tx_cal_controller[view]',
				'noMatch' => 'bypass'
			],
			[
				'GETvar' => 'tx_cal_controller[lastview]',
				'noMatch' => 'bypass'
			],

			[
				'GETvar' => 'tx_cal_controller[year]',

			] ,
			[
				'GETvar' => 'tx_cal_controller[month]',

			] ,
			[
				'GETvar' => 'tx_cal_controller[day]',

			] ,
			[
				'GETvar' => 'tx_cal_controller[uid]',
				'lookUpTable' => [
					'table' => 'tx_cal_event',
					'id_field' => 'uid',
					'alias_field' => 'title',
					'addWhereClause'  => ' AND NOT deleted',
					'useUniqueCache' => 1,
					'useUniqueCache_conf' => [
						'strtolower' => 1,
						'spaceCharacter' => '_',
					],
				],
			],
			[
				'GETvar' => 'tx_cal_controller[gettime]',
				'noMatch' => 'bypass'
			],
			[
				'GETvar' => 'tx_cal_controller[preview]',
				'noMatch' => 'bypass'
			],
		],

		'location' => [
			[
				'GETvar' => 'tx_cal_controller[type]',
				'valueMap' => [
					'detail' => 'tx_cal_location'
				]

			],

			[
				'GETvar' => 'tx_cal_controller[view]',
				'noMatch' => 'bypass'
			],
			[
				'GETvar' => 'tx_cal_controller[lastview]',
				'noMatch' => 'bypass'
			],

			[
				'GETvar' => 'tx_cal_controller[year]',
				'noMatch' => 'bypass'

			] ,
			[
				'GETvar' => 'tx_cal_controller[month]',
				'noMatch' => 'bypass'

			] ,
			[
				'GETvar' => 'tx_cal_controller[day]',
				'noMatch' => 'bypass'

			] ,
			[
				'GETvar' => 'tx_cal_controller[uid]',
				'lookUpTable' => [
					'table' => 'tx_cal_location',
					'id_field' => 'uid',
					'alias_field' => 'name',
					'addWhereClause'  => ' AND NOT deleted',
					'useUniqueCache' => 1,
					'useUniqueCache_conf' => [
						'strtolower' => 1,
						'spaceCharacter' => '_',
					],
				],
			],
			[
				'GETvar' => 'tx_cal_controller[gettime]',
				'noMatch' => 'bypass'
			],
			[
				'GETvar' => 'tx_cal_controller[preview]',
				'noMatch' => 'bypass'
			],
		],

		'40' => 'newsDetailConfiguration',
		'61' => 'cal',
		'62' => 'location'


	],

	'postVarSets' => [
		'_DEFAULT' => [
			/*'cHash'       => [
				[
					'GETvar' => 'cHash',
				]
			], */
			'controller' => [
				[
					'GETvar' => 'tx_news_pi1[action]',
					'noMatch' => 'bypass'
				],
				[
					'GETvar' => 'tx_news_pi1[controller]',
					'noMatch' => 'bypass'
				]
			],
			'dateFilter' => [
				[
					'GETvar' => 'tx_news_pi1[overwriteDemand][year]',
				],
				[
					'GETvar' => 'tx_news_pi1[overwriteDemand][month]',
				],
			],
			'page' => [
				[
					'GETvar' => 'tx_news_pi1[@widget_0][currentPage]',
				],
			],
			'kategorie' => [
				[
					'GETvar' => 'tx_news_pi1[overwriteDemand][categories]',
					'lookUpTable' => [
						'table' => 'sys_category',
						'id_field' => 'uid',
						'alias_field' => 'title',
						'addWhereClause' => ' AND NOT deleted',
						'useUniqueCache' => 1,
						'useUniqueCache_conf' => [
							'strtolower' => 1,
							'spaceCharacter' => '-'
						],
						'languageGetVar' => 'L',
						'languageExceptionUids' => '',
						'languageField' => 'sys_language_uid',
						'transOrigPointerField' => 'l10n_parent',
						'autoUpdate' => 1,
						'expireDays' => 180,

					],

				]
			],

		],
	],
];
?>
