<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "tp3ratings".
 *
 * Auto generated 25-01-2018 22:23
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Tp3Ratings',
  'description' => 'Ratings for Webpages including microdata for google',
  'category' => 'plugin',
  'author' => 'Thomas Ruta',
  'author_email' => 'email@thomasruta.de',
  'state' => 'stable',
  'uploadfolder' => false,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '1.2.5',
    'constraints' =>
        array (
            'depends' =>
                array (
                    'typo3' => '8.7.0-9.0.99',
                    'bootstrap_package' => '8.0.0-8.9.99',
                ),
            'conflicts' =>
                array (

                ),
            'suggests' =>
                array (
                ),
        ),
    'autoload' =>
        array (
            'psr-4' =>
                array (
                    'Tp3\\Tp3ratings\\' => 'Classes',
                ),
        ),
    'clearcacheonload' => false,
    'author_company' => 'tp3',

);

