<?php
defined('TYPO3_MODE') || die();


$tmp_feusers_columns = [


    'reviews' => [
        'exclude' => true,
        'label' => 'reviews',
        'config' => [
			    'type' => 'select',
			    'renderType' => 'selectSingle',
			    'foreign_table' => 'tx_tp3ratings_domain_model_iplog',
                'foreign_field' => 'userid',
			    'minitems' => 0,
			    'maxitems' => 1,

            ],
    ],



];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_feusers_columns);
