<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
  'title' => 'Tp3Ratings',
  'description' => 'Ratings for Webpages including microdata for google',
  'category' => 'plugin',
  'author' => 'Thomas Ruta',
  'author_email' => 'email@thomasruta.de',
  'state' => 'stable',
  'uploadfolder' => false,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '1.3.2',
  'constraints' =>
  [
    'depends' =>
    [
      'typo3' => '8.7.0-10.99.99',
      'bootstrap_package' => '8.0.0-10.9.99',
    ],
    'conflicts' =>
    [
    ],
    'suggests' =>
    [
        'tp3mods' => '*',
    ],
  ],
  'autoload' =>
  [
    'psr-4' =>
    [
      'Tp3\\Tp3ratings\\' => 'Classes',
    ],
  ],
  'clearcacheonload' => false,
  'author_company' => 'tp3',
];
