<?php

namespace TIRS\TirsConfiguration\Hooks\Core\Controller;

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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Resource\Hook\FileDumpEIDHookInterface;
use TYPO3\CMS\Core\Resource\ProcessedFileRepository;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;

class FileDumpController extends \TYPO3\CMS\Core\Controller\FileDumpController {
	/**
	 * Overriding core dump controller to set the content disposition to "attachment" by default
	 *
	 * @param ServerRequestInterface $request
	 * @param ResponseInterface $response
	 * @return NULL|ResponseInterface
	 *
	 * @throws \InvalidArgumentException
	 * @throws \RuntimeException
	 * @throws \TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException
	 * @throws \UnexpectedValueException
	 */
	public function dumpAction(ServerRequestInterface $request, ResponseInterface $response)
	{
		$parameters = array('eID' => 'dumpFile');
		$t = $this->getGetOrPost($request, 't');
		if ($t) {
			$parameters['t'] = $t;
		}
		$f = $this->getGetOrPost($request, 'f');
		if ($f) {
			$parameters['f'] = $f;
		}
		$p = $this->getGetOrPost($request, 'p');
		if ($p) {
			$parameters['p'] = $p;
		}
		if (GeneralUtility::hmac(implode('|', $parameters), 'resourceStorageDumpFile') === $this->getGetOrPost($request, 'token')) {
			if (isset($parameters['f'])) {
				$file = ResourceFactory::getInstance()->getFileObject($parameters['f']);
				if ($file->isDeleted() || $file->isMissing()) {
					$file = null;
				}
			} else {
				$file = GeneralUtility::makeInstance(ProcessedFileRepository::class)->findByUid($parameters['p']);
				if ($file->isDeleted()) {
					$file = null;
				}
			}
			if ($file === null) {
				HttpUtility::setResponseCodeAndExit(HttpUtility::HTTP_STATUS_404);
			}
			// Hook: allow some other process to do some security/access checks. Hook should issue 403 if access is rejected
			if (is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['FileDumpEID.php']['checkFileAccess'])) {
				foreach ($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['FileDumpEID.php']['checkFileAccess'] as $classRef) {
					$hookObject = GeneralUtility::getUserObj($classRef);
					if (!$hookObject instanceof FileDumpEIDHookInterface) {
						throw new \UnexpectedValueException($classRef . ' must implement interface ' . FileDumpEIDHookInterface::class, 1394442417);
					}
					$hookObject->checkFileAccess($file);
				}
			}
			$file->getStorage()->dumpFileContents($file, true);
			exit;
		} else {
			return $response->withStatus(403);
		}
	}
}

?>

?>