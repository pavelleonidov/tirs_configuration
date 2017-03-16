<?php
/*******************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Pavel Leonidov <info@pavel-leonidov.de>
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

// Get extension configuration
$GLOBALS['TIRS_SETTINGS'] = array();
if (!empty($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['tirs_configuration'])) {
	$GLOBALS['TIRS_SETTINGS'] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['tirs_configuration']);
}

// include TSConfig (backend configuration)
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTSConfig/main.ts">');

if (!empty($GLOBALS['TIRS_SETTINGS']['includeConfigurationFiles'])) {
	// @TODO: Provide system configuration files (RealURL base configuration etc.)
}

if (!empty($GLOBALS['TIRS_SETTINGS']['patchFileDumper'])) {
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][TYPO3\CMS\Core\Controller\FileDumpController::class] = array(
		'className' => TIRS\TirsConfiguration\Hooks\Core\Controller\FileDumpController::class
	);
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][TYPO3\CMS\Core\Resource\Processing\ImageCropScaleMaskTask::class] = array(
	'className' => TIRS\TirsConfiguration\Hooks\Core\Resource\Processing\ImageCropScaleMaskTask::class
);

// Hooks
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][GridElementsTeam\Gridelements\Plugin\Gridelements::class] = array(
	'className' => TIRS\TirsConfiguration\Hooks\Gridelements\Plugin\Gridelements::class
);


?>