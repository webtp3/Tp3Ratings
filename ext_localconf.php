<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Tp3.Tp3ratings',
            'Tp3feratings',
            [
                'Ratingsdata' => 'list, new',
                'Iplog' => 'list, show, new',
            ],
            // non-cacheable actions
            [
                'Ratingsdata' => 'create, rating, review',
                'Iplog' => 'create, review',
            ]
        );


        /*
         * Register eID for rateings ajax action-call
         */
        $GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['rating'] = 'EXT:tp3ratings/Classes/Renderer/Tp3Bootstrap.php';//Tp3\Tp3ratings\Controller\RatingsdataController::class . '->RatingAction';//
        $GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['review'] = 'EXT:tp3ratings/Classes/Renderer/Tp3Bootstrap.php';//Tp3\Tp3ratings\Controller\RatingsdataController::class . '->RatingAction';//

        /***************
         * Extend TYPO3 upgrade wizards to handle boostrap package specific upgrades
         */
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\Tp3\Tp3ratings\Updates\Tp3ratingsContentElementUpdate::class]
            = \Tp3\Tp3ratings\Updates\Tp3RatingsContentElementUpdate::class;
        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        tp3feratings {
                            icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_tp3feratings.svg
                            title = LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_tp3feratings
                            description = LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_tp3feratings.description
                            tt_content_defValues {
                                CType = list
                                list_type = tp3ratings_tp3feratings
                            }
                        }
                    }
                    show = *
                }
           }'
        );
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        tp3reviews {
                            icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_tp3reviews.svg
                            title = LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tp3ratings_tp3reviews
                            description = LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tp3ratings_tp3reviews.description
                            tt_content_defValues {
                                CType = list
                                list_type = tp3ratings_tp3reviews
                            }
                        }
                    }
                    show = *
                }
           }'
        );
    },
    $_EXTKEY
);
