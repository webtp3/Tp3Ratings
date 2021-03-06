<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3ratings\Plugin;

/***
 *
 * This file is part of the "tp3 social" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Thomas Ruta <email@thomasruta.de>, R&P IT Consulting GmbH
 *
 ***/
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * FBPlugins
  */
class IplogReviews extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin
{
    public $prefixId      = 'tx_tp3ratings_tp3reviews';		// Same as class name
    public $extKey        = 'tp3ratings';	// The extension key.
    public $pi_checkCHash = true;

    /**
     *
     * @var layout;
     */
    public $layout;

    /**
     * action translate
     *
     * @return string
     */
    private function gettranslation($key)
    {
        //$extensionName = "Tp3share";
        \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, $this->extKey);
    }
    /**
     *
     * @var \TYPO3\CMS\Core\Page\PageRenderer;
     */
    public $pageRenderer;
    /**
     *
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
     */
    public $settings;

    /**
     *
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
     */
    public $cObj;

    /**
     * The main method of the PlugIn
     *
     * @param	string		$content: The PlugIn content
     * @param	array		$conf: The PlugIn configuration
     * @return	The content that is displayed on the website
     */
    public function main($cObj = '', $conf = '')
    {
        $this->conf = $conf;
        $this->cObj = $cObj;
        $this->pi_setPiVarDefaults();
        $this->pi_initPIflexForm();
        $this->ffConf = [];
        $ref = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'ref');
        $reviews = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'reviews');
        return [$ref, $reviews];
        /* if ($content != '') {
             if($this->conf['W3Cmode'] == 1){
                 $content = '<script language="javascript" type="text/javascript">
                     //<![CDATA[
                     document.write(\''.str_replace('
                     ','',$content).'\');
                     //]]>
                     </script>';
             }
             return $this->pi_wrapInBaseClass($content);
         }
         else {
             return '';
         }*/
    }

    /**
     * This method assigns some default variables to the view
     */
    private function setDefaultViewVars()
    {
        $this->extKey = 'Tp3ratings';
        //$this->layout = $this->settings["layout"] ? $this->settings["layout"] : "style05";
        //$this->cObj = GeneralUtility::makeInstance(TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer);
        $this->pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Page\\PageRenderer');
        //$this->view->assign('cObjData', $cObjData);
    }
}
