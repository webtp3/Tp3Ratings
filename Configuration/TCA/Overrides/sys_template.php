<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();
/*
 * // Add an entry in the static template list found in sys_templates for static TS
 *
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('tp3ratings', 'Configuration/TypoScript', 'tp3 Ratings');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('tp3reviews', 'Configuration/TypoScript/Plugin', 'tp3 Reviews');
