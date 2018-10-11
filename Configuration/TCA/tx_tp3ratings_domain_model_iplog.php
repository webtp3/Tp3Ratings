<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_iplog',
        'label' => 'userid',
        'label_alt' => 'ip,ref',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
		'versioningWS' => true,
        //'languageField' => 'sys_language_uid',
        //'transOrigPointerField' => 'l10n_parent',
        //'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
		'searchFields' => 'ratingvalue, userid, ip,ref , cruser_id',
        'iconfile' => 'EXT:tp3ratings/Resources/Public/Icons/tx_tp3ratings_domain_model_iplog.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'hidden, cruser_id,  ratingvalue, userid, review, ip, ref',
    ],
    'types' => [
		'1' => ['showitem' => ' hidden, cruser_id,  ratingvalue, userid, review, ip,  ref, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_tp3ratings_domain_model_iplog',
                'foreign_table_where' => 'AND tx_tp3ratings_domain_model_iplog.pid=###CURRENT_PID### AND tx_tp3ratings_domain_model_iplog.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],*/

		't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'cruser_id' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.cruser_id',
            'config' => [
                'type' => 'inline',
                'items' => array (
                    array('Bitte wählen',''),
                ),
                'foreign_table' => 'fe_users',
                // *** 'foreign_table_where' => 'AND fe_users.uid=###REC_FIELD_cruser_id###',
                'foreign_table_where' => 'AND fe_users.deleted = 0 ORDER BY fe_users.username',
                'minitems' => 1,
                'maxitems' => 1,
                'appearance' => array(
                    'collapse' => 0,
                    'newRecordLinkPosition' => 'bottom',
                )
            ],
        ],
        'crdate' => [
            'label' => 'timestamp',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'renderType' => 'inputDateTime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ]
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
                ],
            ]
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
        'ip' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_iplog.ip',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
        'review' => [
            'exclude' => true,
            'label' => 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_iplog.review',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'softref' => 'typolink_tag,images,email[subst],url',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default'
            ]
        ],
        'ratingvalue' => [
            'exclude' => true,
            'label' => 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_iplog.ratingvalue',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'userid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_iplog.userid',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
	    'ref' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:tp3ratings/Resources/Private/Language/locallang_db.xlf:tx_tp3ratings_domain_model_iplog.ref',
	        'config' => [
			    'type' => 'inline',
			    'foreign_table' => 'tx_tp3ratings_domain_model_ratingsdata',
			    'minitems' => 0,
			    'maxitems' => 1,
			    'appearance' => [
			        'collapseAll' => 0,
			        'levelLinksPosition' => 'top',
			        'showSynchronizationLink' => 1,
			        'showPossibleLocalizationRecords' => 1,
			        'showAllLocalizationLink' => 1
			    ],
			],
	    ],
    ],
];
