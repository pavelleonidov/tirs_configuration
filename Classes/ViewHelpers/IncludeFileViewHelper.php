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

namespace EXCONCEPT\Configuration\ViewHelpers;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * ViewHelper to include a css/js file, SCSS parser included (requires leafo/scssphp in vendor package / composer.json)
 *
 * # Example: Basic example
 * <code>
 * <exc:includeFile path="{settings.cssFile}" />
 * </code>
 * <output>
 * This will include the file provided by {settings} in the header
 *
 * To include the file in the footer, use the ViewHelper like this:
 * <code>
 * <exc:includeFile path="{settings.cssFile}" footer="TRUE" />
 * </code>
 *
 * </output>
 *
 */
class IncludeFileViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

	/**
	 * Include a CSS/JS file
	 *
	 * @param string $path Path to the CSS/JS file which should be included
	 * @param bool $compress Define if file should be compressed
	 * @param bool $footer Define if file should be included to bottom
	 * @param bool $async Define if file should be asynchronously loaded
	 * @return void
	 */
	public function render($path, $compress = false, $bottom=false, $async=false)
	{
		$pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
		$path = TYPO3_MODE == 'FE' ? $GLOBALS['TSFE']->tmpl->getFileName($path) : $path;

		$fileExt = strtolower(pathinfo($path, PATHINFO_EXTENSION));

		switch($fileExt) {
			case "js":
				$method = $bottom ? 'addJsFooterFile' : 'addJsFile';
				$pageRenderer->$method($path, 'text/javascript', $compress, false, '', !$compress, '|', $async);
				break;
			case "css":
				$method = $bottom ? 'addCssFooterFile' : 'addCssFile';
				$pageRenderer->$method($path, 'stylesheet', 'all', '', $compress, false, '', !$compress);
				break;
			case "scss":
				$method = $bottom ? 'addCssFooterFile' : 'addCssFile';
				// Note: as leafo's scssphp often does not properly compile SCSS code, this option is abandoned now. There are better ways to implement runtime compiler, e. g. node-sass with nodemon (See https://github.com/pavelleonidov/tirs_foundation for a working package.json configuration)

				/*if(TYPO3_MODE == 'FE') {
					$file = basename($path);
					$dir = dirname(str_replace("typo3conf/ext/", "", $path));
					$pageRenderer->$method($GLOBALS['TSFE']->tmpl->getFileName("EXT:tirs_configuration/Resources/Public/PHP/scss.php?dir=" . $dir . "&p=" . $file), 'stylesheet', 'all', '', false, false, '', true);
				}*/

				break;
			default:
				throw new \Exception("invalid file format", 12800912);
				break;
		}
	}
}

?>