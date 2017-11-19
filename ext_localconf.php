<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Tp3.Tp3ratings',
            'Tp3feratings',
            [
                'Ratingsdata' => 'list, new, create, rating',
                'Iplog' => 'list, new, create'
            ],
            // non-cacheable actions
            [
                'Ratingsdata' => 'create, rating',
            		'Iplog' => 'create'
            ]
        );


        /*
         * Register eID for rateings ajax action-call
         */
        $GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['rating'] = 'EXT:tp3ratings/Classes/Renderer/Tp3Bootstrap.php';//Tp3\Tp3ratings\Controller\RatingsdataController::class . '::RatingAction';//

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
    },
    $_EXTKEY
);
