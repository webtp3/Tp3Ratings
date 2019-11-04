<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

/* Set up the tt_content fields for the frontend plugins */

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['tp3ratings_tp3feratings']='layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['tp3ratings_tp3feratings']='pi_flexform';
//$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['tx_tp3ratings_domain_model_ratingsdata']='pi_flexform';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['tp3ratings_tp3reviews']='layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['tp3ratings_tp3reviews']='pi_flexform';

/* Add the plugins */
$pluginSignature = 'Tp3feratings';
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Tp3.Tp3ratings',
    $pluginSignature,
    'tp3 Ratings FE'
);

$pluginSignature = 'Tp3reviews';
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Tp3.Tp3ratings',
    $pluginSignature,
    'tp3 Reviews'
);
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(Array('LLL:EXT:tp3ratings/Resources/Private/Languages/locallang_db.xlf:tt_content.tp3ratings_tp3feratings', 'tp3ratings_tp3feratings'),'list_type', 'tp3ratings');
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(Array('LLL:EXT:tp3ratings/Resources/Private/Languages/locallang_db.xlf:tt_content.tp3ratings_tp3reviews', 'tp3ratings_tp3reviews'),'list_type', 'tp3ratings');

/* Add the flexforms to the TCA */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('tp3ratings_tp3feratings', 'FILE:EXT:tp3ratings/Configuration/FlexForms/flexform_ds.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('tp3ratings_tp3reviews', 'FILE:EXT:tp3ratings/Configuration/FlexForms/flexform_reviews.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tp3ratings_domain_model_ratingsdata', 'EXT:tp3ratings/Resources/Private/Language/locallang.de.xlf');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tp3ratings_domain_model_iplog', 'EXT:tp3ratings/Resources/Private/Language/locallang_csh_tx_tp3ratings_domain_model_iplog.xlf');
