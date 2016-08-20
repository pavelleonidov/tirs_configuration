<?php
namespace TIRS\TirsConfiguration\ViewHelpers\Link;
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

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ProcessedFile;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ViewHelper to generate a streamed download link for a file
 *
 * # Example: Basic example
 * <code>
 * <tirs:link.download file="{file}">Download</tirs:link.download>
 * </code>
 *
 */
class DownloadViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{

	/**
	 * @var string
	 */
	protected $tagName = 'a';

	/**
	 * Arguments Initialization
	 *
	 * @return void
	 */
	public function initializeArguments()
	{
		$this->registerUniversalTagAttributes();
	}

	/**
	 * Generates a streamed download link
	 *
	 * Usage:
	 * <code>
	 *     {namespace tirs=TIRS\Configuration\ViewHelpers}
	 *
	 *     <tirs:link.download file="{model.file.originalResource.originalFile}" title="Download" class="myDownload">
	 *      <div>...</div>
	 *     </tirs:link.download>
	 * </code>
	 *
	 * @param \TYPO3\CMS\Core\Resource\FileInterface $file file
	 * @return string Rendered link
	 * @see \TYPO3\CMS\Core\Resource\ResourceStorage::getPublicUrl()
	 */
	public function render(\TYPO3\CMS\Core\Resource\FileInterface $file)
	{
		$queryParameterArray = array('eID' => 'dumpFile', 't' => '');
		if ($file instanceof File) {
			$queryParameterArray['f'] = $file->getUid();
			$queryParameterArray['t'] = 'f';
		} elseif ($file instanceof  ProcessedFile) {
			$queryParameterArray['p'] = $file->getUid();
			$queryParameterArray['t'] = 'p';
		}

		$queryParameterArray['token'] = GeneralUtility::hmac(implode('|', $queryParameterArray), 'resourceStorageDumpFile');
		$publicUrl = 'index.php?' . str_replace('+', '%20', http_build_query($queryParameterArray));


		$this->tag->addAttribute('href', $publicUrl);
		$this->tag->setContent($this->renderChildren());
		$this->tag->forceClosingTag(TRUE);
		return $this->tag->render();
	}
}

?>