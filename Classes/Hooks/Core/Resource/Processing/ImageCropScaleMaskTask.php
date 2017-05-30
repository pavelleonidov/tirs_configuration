<?php
namespace TIRS\TirsConfiguration\Hooks\Core\Resource\Processing;

/*******************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Pavel Leonidov <info@pavel-leonidov.de>
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

class ImageCropScaleMaskTask extends \TYPO3\CMS\Core\Resource\Processing\ImageCropScaleMaskTask {
	/**
	 * Gets the file extension the processed file should
	 * have in the filesystem by either using the configuration
	 * setting, or the extension of the original file.
	 *
	 * @return string
	 */
	protected function determineTargetFileExtension()
	{


		if (!empty($this->configuration['fileExtension'])) {
			$targetFileExtension = $this->configuration['fileExtension'];
		} elseif (in_array($this->getSourceFile()->getExtension(), ['jpg', 'jpeg', 'png', 'gif'], true)) {
			$targetFileExtension = $this->getSourceFile()->getExtension();
			// If true, thumbnails from non-processable files will be converted to 'png', otherwise 'gif'
		} elseif ($this->getSourceFile()->getExtension() == 'pdf') {
			$targetFileExtension = 'jpg';
		}
		elseif ($GLOBALS['TYPO3_CONF_VARS']['GFX']['thumbnails_png']) {
			$targetFileExtension = 'png';
		} else {
			$targetFileExtension = 'gif';
		}
		return $targetFileExtension;
	}
}

?>