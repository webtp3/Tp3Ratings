<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3ratings\Renderer;

/**/

/**
 * Gets the Ajax Call Parameters
 */
$_gp =     \TYPO3\CMS\Core\Utility\GeneralUtility::_GET();
// Post not needed
//$_gp = \TYPO3\CMS\Core\Utility\ArrayUtility::arrayMergeRecursiveOverrule(
//    $_gp,
//    \TYPO3\CMS\Core\Utility\GeneralUtility::_GET()
//);

/**
 * @var $TSFE \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
 */
$TSFE = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController', $TYPO3_CONF_VARS, 0, 0);
$GLOBALS['TSFE'] = $TSFE;

\TYPO3\CMS\Frontend\Utility\EidUtility::initLanguage();
\TYPO3\CMS\Frontend\Utility\EidUtility::initTCA();
// Get FE User Information
$TSFE->initFEuser();
$TSFE->initUserGroups();
// Important: no Cache for Ajax stuff
$TSFE->set_no_cache();

$TSFE->checkAlternativeIdMethods();
$TSFE->determineId();
$TSFE->initTemplate();
$TSFE->getConfigArray();
\TYPO3\CMS\Core\Core\Bootstrap::getInstance();

$TSFE->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
$TSFE->settingLanguage();
$TSFE->settingLocale();

/**
 * Initialize Backend-User (if logged in)
 */
$GLOBALS['BE_USER'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Authentication\BackendUserAuthentication');
$GLOBALS['BE_USER']->start();

/**
 * Initialize Database
 */
$TSFE->connectToDB();

$ajax = [];
$ajax['arguments']	= $_gp;
$ajax['vendorName'] 	= 'Tp3';
$ajax['extensionName'] 	= 'Tp3ratings';
$ajax['pluginName'] 	= 'Tp3feratings';
$ajax['controller'] 	= 'Ratingsdata';
//prevent injection of action
$ajax['action'] 	= $_gp['eID'] == 'review' ? 'review' : 'rating';
/**
 * @var $objectManager \TYPO3\CMS\Extbase\Object\ObjectManager
 */
$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');

/**
 * Initialize Extbase bootstap
 */
$bootstrapConf['extensionName'] = $ajax['extensionName'];
$bootstrapConf['pluginName']	= $ajax['pluginName'];

$bootstrap = new \TYPO3\CMS\Extbase\Core\Bootstrap($ajax);
$bootstrap->initialize($ajax);
$bootstrap->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');

/**
 * Build the request
 */
$request = $objectManager->get('TYPO3\CMS\Extbase\Mvc\Request');

$request->setControllerVendorName($ajax['vendorName']);
$request->setcontrollerExtensionName($ajax['extensionName']);
$request->setPluginName($ajax['pluginName']);
$request->setControllerName($ajax['controller']);
$request->setControllerActionName($ajax['action']);
$request->setArguments($ajax['arguments']);

//$ajaxDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Nng\Nnsubscribe\Controller\EidController');
//echo $ajaxDispatcher->processRequestAction();

$response = $objectManager->get('TYPO3\CMS\Extbase\Mvc\ResponseInterface');
$dispatcher = $objectManager->get('TYPO3\CMS\Extbase\Mvc\Dispatcher');
$dispatcher->dispatch($request, $response);

echo $response->getContent();
