<?php
defined('TYPO3_MODE') || die();
/*
 * // Add an entry in the static template list found in sys_templates for static TS
 *
 */

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('tp3ratings', 'Configuration/TypoScript', 'tp3 Ratings');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('tp3reviews', 'Configuration/TypoScript/Plugin', 'tp3 Reviews');