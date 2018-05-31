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

$EM_CONF[$_EXTKEY] = array(
	'title' => 'TIRS Combined Configuration',
	'description' => 'Base frontend and backend configuration with useful core patches and ViewHelpers',
	'category' => 'plugin',
	'author' => 'Pavel Leonidov',
	'author_email' => 'info@pavel-leonidov.de',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '8.3.1',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.6.0-8.6.99',
			'fluid_styled_content' => '7.6.0-8.7.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

?>