<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die('Access denied.');

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

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Tp3.Tp3ratings',
            'Tp3reviews',
            [
                'Iplog' => 'list, show, new',
            ],
            // non-cacheable actions
            [
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
                            iconIdentifier = ext-' . $_EXTKEY . '-wizard-icon
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
                        	iconIdentifier = ext-' . $_EXTKEY . '-review-wizard-icon
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
        /*
       * Icons
       */
        if (TYPO3_MODE === 'BE') {
            $icons = [
                'ext-' . $_EXTKEY . '-wizard-icon' => 'user_plugin_tp3feratings.svg',
                'ext-' . $_EXTKEY . '-review-wizard-icon' => 'user_plugin_tp3reviews.svg',

            ];
            $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
            foreach ($icons as $identifier => $path) {
                $iconRegistry->registerIcon(
                    $identifier,
                    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                    ['source' => 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/' . $path]
                );
            }
        }
