<?php
/*******************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Pavel Leonidov <pavel.leonidov@exconcept.com>, EXCONCEPT GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as
 *  published by the Free Software Foundation; either version 2 of
 *  the License, or (at your option) any later version.
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

$ll = 'LLL:EXT:tirs_configuration/Resources/Private/Language/locallang_db.xlf:';
$fscPrefix = 'LLL:EXT:fluid_styled_content/Resources/Private/Language/Database.xlf:';

$tempColumns = [
	'logo' => [
		'exclude' => 1,
		'label' => $ll . 'pages.logo',
		'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('logo', [
			'appearance' => [
				'createNewRelationLinkTitle' => $fscPrefix . 'tt_content.asset_references.addFileReference'
			],
			// custom configuration for displaying fields in the overlay/reference table
			// behaves the same as the image field.
			'foreign_types' => $GLOBALS['TCA']['tt_content']['columns']['image']['config']['foreign_types']
		], $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'])
	],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', '--div--;' . $ll . 'pages.logo, logo');

?>