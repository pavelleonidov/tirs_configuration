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
		} else {
			// explanation for "thumbnails_png"
			// Bit0: If set, thumbnails from non-jpegs will be 'png', otherwise 'gif' (0=gif/1=png).
			// Bit1: Even JPG's will be converted to png or gif (2=gif/3=png)

			$targetFileExtensionConfiguration = $GLOBALS['TYPO3_CONF_VARS']['GFX']['thumbnails_png'];
			if ($this->getSourceFile()->getExtension() === 'jpg' || $this->getSourceFile()->getExtension() === 'jpeg') {
				if ($targetFileExtensionConfiguration == 2) {
					$targetFileExtension = 'gif';
				} elseif ($targetFileExtensionConfiguration == 3) {
					$targetFileExtension = 'png';
				} else {
					$targetFileExtension = 'jpg';
				}
			} else {
				// check if a png or a gif should be created
				if ($targetFileExtensionConfiguration == 1 || $this->getSourceFile()->getExtension() === 'png') {
					$targetFileExtension = 'png';
				}
				elseif ($targetFileExtensionConfiguration == 4) {
					$targetFileExtension = 'jpg';
				} else {
					// thumbnails_png is "0"
					$targetFileExtension = 'gif';
				}
			}
		}

		return $targetFileExtension;
	}
}

?>