<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_ratingsdata',
        'label' => 'rating',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        //'languageField' => 'sys_language_uid',
       // 'transOrigPointerField' => 'l10n_parent',
      //  'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'rating,votecount,ref',
        'iconfile' => 'EXT:tp3ratings/Resources/Public/Icons/tx_tp3ratings_domain_model_ratingsdata.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, rating, votecount, ref',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, rating, votecount, ref, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
    /*	'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_tp3ratings_domain_model_ratingsdata',
                'foreign_table_where' => 'AND tx_tp3ratings_domain_model_ratingsdata.pid=###CURRENT_PID### AND tx_tp3ratings_domain_model_ratingsdata.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],*/
        'pi_flexform' => [
            'label' => 'tp3 Konfig',
            'displayCond' => '',
            'config' => [
                'type' => 'flex',
                'ds_pointerField' => 'pi_flexform',
                'ds' => [
                    'default' => 'FILE:EXT:tp3ratings/Configuration/FlexForms/flexform_ds.xml',
                ],
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'renderType' => 'inputDateTime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],            ]
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'renderType' => 'inputDateTime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
        ],
        'rating' => [
            'exclude' => true,
            'label' => 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_ratingsdata.rating',
            'config' => [
                'type' => 'input',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'votecount' => [
            'exclude' => true,
            'label' => 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_ratingsdata.votecount',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'ref' => [
            'exclude' => true,
            'label' => 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_ratingsdata.ref',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    ],
];
