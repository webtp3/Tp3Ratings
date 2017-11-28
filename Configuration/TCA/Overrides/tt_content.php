<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

/* Set up the tt_content fields for the frontend plugins */

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['tp3ratings_tp3feratings']='layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['tp3ratings_tp3feratings']='pi_flexform';

/* Add the plugins */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(Array('LLL:EXT:tp3ratings/Resources/Private/Languages/locallang_db.xlf:tt_content.list_type_pi1', 'tp3ratings_tp3feratings'),'list_type', 'tp3ratings');

/* Add the flexforms to the TCA */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('tp3ratings_tp3feratings', 'FILE:EXT:tp3ratings/Configuration/FlexForms/flexform_ds.xml');

?>