<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "tp3ratings".
 *
 * Auto generated 21-05-2018 23:13
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
  'version' => '1.4.1',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '9.5.0-10.99.99',
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

