<?php
namespace TIRS\TirsConfiguration\ViewHelpers;

/*******************************************************************
 *  Copyright notice
 *
 *  (c) 2016 - 2018 Pavel Leonidov <info@pavel-leonidov.de>
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


  
  class InArrayViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper
  {

      /**
       * Initialize ViewHelper arguments
       */
      public function initializeArguments()
      {
          $this->registerArgument('needle', 'mixed', 'The usergroup (either the usergroup uid or its title).');
          $this->registerArgument('haystack', 'mixed', 'The usergroup (either the usergroup uid or its title).');
          $this->registerArgument('subPart', 'string', 'The usergroup (either the usergroup uid or its title).');
          $this->registerArgument('type', 'string', 'The usergroup (either the usergroup uid or its title).');
          $this->registerArgument('allowEmpty', 'boolean', 'The usergroup (either the usergroup uid or its title).', FALSE,TRUE);
      }

      /**
       * This method decides if the condition is TRUE or FALSE. It can be overridden in extending viewhelpers to adjust functionality.
       *
       * @param array $arguments ViewHelper arguments to evaluate the condition for this ViewHelper, allows for flexiblity in overriding this method.
       * @return bool
       */
      protected static function evaluateCondition($arguments = null)
      {
          $needle = $arguments['needle'];
          $haystack = $arguments['haystack'];
          $subPart = $arguments['subPart'];
          $type = $arguments['type'];
          $allowEmpty = $arguments['allowEmpty'];


          // is haystack is a string, split if at commas
          if (is_string($haystack)) {
              $haystack = explode(',', $haystack);
          }

          // get the subpart of the array
          $haystack = self::getHaystackSubPart($haystack, $subPart);
          if (!empty($haystack) && ($allowEmpty === true || ($allowEmpty === false && !empty($needle)))) {
              self::parseToType($type, $needle, $haystack);

              // render then/else if value exists in array
              return in_array($needle, $haystack);
          }

          // render else
          return false;
      }

      /**
       * @return mixed
       */
      public function render()
      {
          if (static::evaluateCondition($this->arguments)) {
              return $this->renderThenChild();
          } else {
              return $this->renderElseChild();
          }
      }

    /**
     * parse needle and haystack for comparation
     *
     * @param string $type
     * @param mixed $needle
     * @param array $haystack
     */
    protected static function parseToType($type, &$needle, &$haystack)
    {

      switch (strtolower($type)) {

        case 'string':
          $needle = strval($needle);
          $haystack = array_map('strval', $haystack);
        break;

        case 'int':
          $needle = intval($needle);
          $haystack = array_map('intval', $haystack);
        break;

        case 'float':
          $needle = floatval($needle);
          $haystack = array_map('floatval', $haystack);
        break;

        case 'bool':
        case 'boolean':
          $needle = boolval($needle);
          $haystack = array_map('boolval', $haystack);
        break;

      }

    }

    /**
     * gets the subpart of the haystack
     *
     * @param array $haystack
     * @param string $subPart
     * @return array
     */
    protected static function getHaystackSubPart($haystack, $subPart)
    {

      // if a subpart is set
      if (!empty($subPart)) {

        // explode the subpart to get into deeper parts
        $keys = explode('.', $subPart);

        // loop throught the keys
        foreach ($keys as $key) {

          // if the subpart exists, use it
          if (!empty($key) && isset($haystack[$key])) {
            $haystack = $haystack[$key];
          // return empty array if no subpart was found
          } else {
            return array();
          }

        }

      }

      // return the found subpart
      return array_values($haystack);

    }

  }

?>