<?php

namespace TIRS\TirsConfiguration\Hooks\Gridelements\Plugin;

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

/**
 * Extending Gridelements to pass child raw data into the raw columns array
 */

class Gridelements extends \GridElementsTeam\Gridelements\Plugin\Gridelements {

	/**
	 * renders the children of the grid container and
	 * puts them into their respective columns
	 *
	 * @param array $typoScriptSetup
	 * @param array $sortColumns : An Array of column positions within the grid container in the order they got in the grid setup
	 */
	public function renderChildrenIntoParentColumns($typoScriptSetup = array(), $sortColumns = array())
	{

		// first we have to make a backup copy of the original data array
		// and we have to modify the depth counter to avoid stopping too early
		$currentParentGrid = $this->copyCurrentParentGrid();
		$columns = $this->getUsedColumns($sortColumns);
		$parentGridData = $this->getParentGridData($currentParentGrid['data']);
		$parentGridData['tx_gridelements_view_columns'] = $columns;

		$counter = !empty($this->cObj->data['tx_gridelements_view_children']);
		$parentRecordNumbers = array();
		$this->getTSFE()->cObjectDepthCounter += $counter;

		// each of the children will now be rendered separately and the output will be added to it's particular column
		$rawColumns = array();
		if (!empty($this->cObj->data['tx_gridelements_view_children'])) {
			foreach ($this->cObj->data['tx_gridelements_view_children'] as $child) {

				$rawColumns[$child['tx_gridelements_columns']][] = $child;

				$key = key($rawColumns[$child['tx_gridelements_columns']]);

				$renderedChild = $child;
				$this->renderChildIntoParentColumn($columns, $renderedChild, $parentGridData, $parentRecordNumbers,
					$typoScriptSetup);

				$rawColumns[$child['tx_gridelements_columns']][$key]['rawData'] = $currentParentGrid['data']['tx_gridelements_view_child_' . $child['uid']] =  $renderedChild;

				next($rawColumns[$child['tx_gridelements_columns']]);
				unset($renderedChild);

			}
			$currentParentGrid['data']['tx_gridelements_view_raw_columns'] = $rawColumns;

		}

		// now we can reset the depth counter and the data array so that the element will behave just as usual
		// it will just contain the additional tx_gridelements_view section with the prerendered elements
		// it is important to do this before any stdWrap functions are applied to the grid container
		// since they will depend on the original data
		$this->getTSFE()->cObjectDepthCounter -= $counter;

		$this->cObj->currentRecord = $currentParentGrid['record'];
		$this->cObj->data = $currentParentGrid['data'];
		$this->cObj->parentRecordNumber = $currentParentGrid['parentRecordNumber'];

		if (!empty($sortColumns)) {
			$this->cObj->data['tx_gridelements_view_columns'] = array();
			foreach ($sortColumns as $sortKey) {
				$sortKey = trim($sortKey);
				if (isset($parentGridData['tx_gridelements_view_columns'][$sortKey])) {
					$this->cObj->data['tx_gridelements_view_columns'][$sortKey] = $parentGridData['tx_gridelements_view_columns'][$sortKey];
				}
			}
		}
		unset($parentGridData);
		unset($currentParentGrid);

	}
}

?>