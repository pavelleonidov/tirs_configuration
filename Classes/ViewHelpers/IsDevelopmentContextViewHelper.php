<?php

/*******************************************************************
 *  Copyright notice
 *
 *  (c) 2017 - 2018 Pavel Leonidov <info@pavel-leonidov.de>
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


namespace TIRS\TirsConfiguration\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class IsDevelopmentContextViewHelper
 *
 * @package In2code\Powermail\ViewHelpers\Condition
 */
class IsDevelopmentContextViewHelper extends AbstractViewHelper
{

    /**
     * Check if Development context is active
     *
     * @return bool
     */
    public function render()
    {
        return GeneralUtility::getApplicationContext()->isDevelopment();
    }
}

?>