<?php
defined('TYPO3_MODE') || die('Access denied.');


       
       // \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'tp3ratings');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tp3ratings_domain_model_ratingsdata');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tp3ratings_domain_model_iplog');


        
        $tx_tp3ratings_tp3feratings_sysconf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
        $tx_tp3ratings_tp3feratings_debug_mode_disabled = is_array($tx_tp3ratings_tp3feratings_sysconf) && !intval($tx_tp3ratings_tp3feratings_sysconf['debugMode']);


        /*
         *  moved to tcs / overrides
        */
       /* $GeneralUtility = '\TYPO3\CMS\Core\Utility\GeneralUtility';
        $ExtensionManagementUtility = '\TYPO3\CMS\Core\Utility\ExtensionManagementUtility';
        $ExtensionUtility = '\TYPO3\CMS\Extbase\Utility\ExtensionUtility';
        if ($ExtensionManagementUtility::isLoaded('tt_news')) {
            // New columns
            $tempColumns = array (
                'tx_tp3ratings_tp3feratings_enable' => Array (
                    'exclude' => 1,
                    'label' => 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tt_news.tx_tp3ratings_tp3feratings_enable',
                    'config' => array (
                        'type'     => 'check',
                        'items'    => array(
                            array('', '')
                        ),
                        'default'  => '1'
                    )
                ),
            );

            $ExtensionManagementUtility::addTCAcolumns('tt_news', $tempColumns, 1);
            $ExtensionManagementUtility::addToAllTCAtypes('tt_news', 'tx_tp3ratings_tp3feratings_enable;;;;1-1-1');
        }*/
       // $TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_'.strtolower($pluginSignature)]='pi_flexform';
        //\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($_EXTKEY.'_'.strtolower($pluginSignature), 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/'.$pluginSignature.'.xml');
       //$ExtensionManagementUtility::addPiFlexFormValue($_EXTKEY.'_'.strtolower($pluginSignature), 'FILE:EXT:'.$_EXTKEY.'Configuration/FlexForms/flexform_ds.xml');
       // $ExtensionManagementUtility::addPlugin(array('LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1', $_EXTKEY.'_tp3feratings'),'list_type');
        

