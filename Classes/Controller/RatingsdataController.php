<?php
namespace Tp3\Tp3ratings\Controller;

/***
 *
 * This file is part of the "tp3_ratings" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Thomas Ruta <email@thomasruta.de>, R&P IT Consulting GmbH
 *
 ***/
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Core\Page\PageRenderer;
use FluidTYPO3\Vhs\ViewHelpers;

/**
 * RatingsdataController
 */
class RatingsdataController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     *
     * @var string;
     */
    private static $extKey = "tp3ratings";
    /**
     *
     * @var string;
     */
    private static $layout = "";

    /**
     *
     * @var array;
     */
    private static $conf;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     *
     */

    protected $persistenceManager;


    /**
     *
     * @var \TYPO3\CMS\Core\Page\PageRenderer
     */

    protected $pageRenderer;

    /**
    /**
     *
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    protected  $cObjRenderer;

    /**
     * ratingsdataRepository
     *
     * @var \Tp3\Tp3ratings\Domain\Repository\RatingsdataRepository
     * @inject
     */
    protected $ratingsdataRepository = null;

    /**
     * view
     *
     * @var \Tp3\Tp3ratings\View\Rating
     * @inject
     */
    protected $view = null;
    /**
     * IplogRepository
     *
     * @var \Tp3\Tp3ratings\Domain\Repository\IplogRepository
     * @inject
     */
    protected $iplogRepository = null;
    /**
     * @var string
     */
    protected $entityNotFoundMessage = 'The requested entity could not be found.';

    /**
     * @var string
     */
    protected $unknownErrorMessage = 'An unknown error occurred. The wild monkey horde in our basement will try to fix this as soon as possible.';


    /**
     * Generates HTML code for displaying ratings.
     *
     * @param	string		$ref	Reference
     * @param	array		$conf	Configuration array
     * @return	string		HTML content
     */
    public function getRatingDisplay() {
        $rating = $this->ratingsdataRepository->findbyStorgePid($GLOBALS['TSFE']->id);
        if ($rating instanceof \Tp3\Tp3ratings\Domain\Model\Ratingsdata && $rating->getVotecount() > 0) {
            $rating_value = $rating->getRating()/$rating->getVotecount();
        } else {
            $rating = $this->objectManager->get('Tp3\\Tp3ratings\\Domain\\Model\\Ratingsdata');
            $rating_value = 0;
            //$rating_str = $language->sL('LLL:EXT:tp3ratings/Resources/Private/Language/locallang.xml:api_not_rated');
        }

        $data = serialize(array(
            'pid' => $GLOBALS['TSFE']->id,
            'conf' => $this->settings,
            'lang' => $GLOBALS['TSFE']->lang,
        ));
        if ($ref == "")$ref=$GLOBALS['TSFE']->id;
        $ajaxData = base64_encode($data);
        // Create links
        $links = '';

        for ($i = $this->settings['minValue']; $i <= $this->settings['maxValue']; $i++) {
            $check = md5($ref . $i . $ajaxData . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
            $rating->SetOptions( array(
                'value' => intval($i),
                'ref' => $ref,
                'pid' => $GLOBALS['TSFE']->id,
                'check' => $check,
                'path' => $siteRelPath,
                'rating'=> intval(round( $rating->getRating())),
                'ratingdata' => rawurlencode($ajaxData),
            ));
        }

        /*if ($conf['mode'] == 'static' || (!$conf['disableIpCheck'] && $this->isVoted($ref))) {
            $subTemplate = $this->cObj->getSubpart($template, '###TEMPLATE_RATING_STATIC###');
            $links = '';
        } else {
            $subTemplate = $this->cObj->getSubpart($template, '###TEMPLATE_RATING###');
            $voteSub = $this->cObj->getSubpart($template, '###VOTE_LINK_SUB###');
            // Make ajaxData
            $confCopy = $conf;
            unset($confCopy['userFunc']);

        }

        $markers = array(
                '###PID###' => $GLOBALS['TSFE']->id,
                '###REF###' => htmlspecialchars($ref),
                '###TEXT_SUBMITTING###' => $language->sL('LLL:EXT:tp3ratings/Resources/Private/Language/locallang.xml:api_submitting'),
                '###TEXT_ALREADY_RATED###' => $language->sL('LLL:EXT:tp3ratings/locallang.xml:api_already_rated'),
                '###BAR_WIDTH###' => $this->getBarWidth($rating_value, $conf),
                '###RATING###' => $rating_str,
                '###TEXT_RATING_TIP###' => $language->sL('LLL:EXT:tp3ratings/Resources/Private/Language/locallang.xml:api_tip'),
                '###SITE_REL_PATH###' => $siteRelPath,
                '###VOTE_LINKS###' => $links,
                '###RAW_COUNT###' => $this->cObj->stdWrap($rating['vote_count'], $conf['voteCountStdWrap.']),
                '###REVIEW_COUNT###' => $this->cObj->stdWrap($rating['vote_count'], $conf['reviewCountStdWrap.']),
                '###RAW_VOTE###' => $this->cObj->stdWrap($rating['rating'], $conf['ratingVoteStdWrap.']),
                '###RAW_VOTE_MAX###' => $this->cObj->stdWrap($conf['maxValue'], $conf['ratingMaxValueStdWrap.']),
                '###RAW_VOTE_MIN###' => $this->cObj->stdWrap($conf['minValue'], $conf['ratingMinValueStdWrap.']),
        );
        // Get template
        */
        return $rating;
    }


    /**
     * Initializes the current action
     *
     * @return void
     */
    public function initializeAction()
    {
        //$this->setDefaultViewVars();

        //$this->Div = new Tp3Eid();
    }
    /**
     * @param \TYPO3\CMS\Extbase\Mvc\RequestInterface $request
     * @param \TYPO3\CMS\Extbase\Mvc\ResponseInterface $response
     *  @return void
     * @throws \Exception
     * @override \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
     */
    public function processRequest(\TYPO3\CMS\Extbase\Mvc\RequestInterface $request, \TYPO3\CMS\Extbase\Mvc\ResponseInterface $response) {
        if (count($request->getArguments())> 0 &&  $request->getArgument("eID") == "rating" && $request->hasArgument("ratingdata") ) {
            //&& $this->resolveActionMethodName() == "ratingAction"
            $data_str = $request->getArgument("ratingdata");
            $request->SetArgument("ratingdata", unserialize(base64_decode($data_str)));
            if($request->hasArgument("check"))$request->SetArgument("check",$request->getArgument("check"));
        }
        try {
            parent::processRequest($request, $response);
        }
        catch(\TYPO3\CMS\Extbase\Property\Exception $e) {
            if ($e->getPrevious() instanceof \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException) {
                $GLOBALS['TSFE']->pageNotFoundAndExit('kaputt.');
            } else {
                throw $e;
            }
        }
    }
    /**
     * @return void
     * @override \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
     */
    protected function callActionMethod() {
        try {
            parent::callActionMethod();
        }
        catch(\Exception $exception) {
            // This enables you to trigger the call of TYPO3s page-not-found handler by throwing \TYPO3\CMS\Core\Error\Http\PageNotFoundException
            if ($exception instanceof \TYPO3\CMS\Core\Error\Http\PageNotFoundException) {
                $GLOBALS['TSFE']->pageNotFoundAndExit($this->entityNotFoundMessage);
            }

            // $GLOBALS['TSFE']->pageNotFoundAndExit has not been called, so the exception is of unknown type.
          //  \Tp3\Tp3ratings\Logger\ExceptionLogger::log($exception, $this->request->getControllerExtensionKey(), \VendorName\ExtensionName\Logger\ExceptionLogger::SEVERITY_FATAL_ERROR);
            // If the plugin is configured to do so, we call the page-unavailable handler.
            if (isset($this->settings['usePageUnavailableHandler']) && $this->settings['usePageUnavailableHandler']) {
                $GLOBALS['TSFE']->pageUnavailableAndExit($this->unknownErrorMessage, 'HTTP/1.1 500 Internal Server Error');
            }
            // Else we append the error message to the response. This causes the error message to be displayed inside the normal page layout. WARNING: the plugins output may gets cached.
            if ($this->response instanceof \TYPO3\CMS\Extbase\Mvc\Web\Response) {
                $this->response->setStatus(500);
            }
            $this->response->appendContent($this->unknownErrorMessage);
        }
    }
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $this->setDefaultViewVars();
        //	$this->cObjRenderer->start('', '');
        $ratingsdatas = $this->getRatingDisplay();
        //$ratingsdatas = $this->ratingsdataRepository->findAll();
        //var_dump($ratingsdatas);
        //   $this->pageRenderer->addFooterData('<script type="text/javascript" src="typo3conf/ext/tp3ratings/Resources/Public/Javascript/tp3ratings.js"></script>');
        $this->view->assign('ratingstext', sprintf($this->gettranslation('api_rating'), $ratingsdatas->getRating()/$ratingsdatas->getVotecount(),$this->settings["maxValue"], $ratingsdatas->getVotecount()));

        $this->view->assign('ratingsdata', $ratingsdatas);
    }

    /**
     * action show
     *
     * @param \Tp3\Tp3ratings\Domain\Model\Ratingsdata $ratingsdata
     * @return void
     */
    public function showAction(\Tp3\Tp3ratings\Domain\Model\Ratingsdata $ratingsdata)
    {
        $this->view->assign('ratingsdata', $ratingsdata);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }
    /**
     * action rating
     *
     * @param \Tp3\Tp3ratings\Domain\Model\Ratingsdata $ratingsdata
     * @return void
     */
    public function RatingAction()
    {
        $this->setDefaultViewVars();
        //$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $ratingsdata = $this->ratingsdataRepository->findbyStorgePid( $this->request->hasArgument("ref") ? $this->request->getArgument("ref") :$GLOBALS["TSFE"]->page["uid"])->getFirst();
        $iplog = $this->iplogRepository->findbyIpandRef($GLOBALS["_SERVER"]["REMOTE_ADDR"],$GLOBALS["TSFE"]->page["uid"])->getFirst();
        // $this->settings["disableIpCheck"] = 1;
        if($this->settings["disableIpCheck"] == 1 || !$iplog instanceof \Tp3\Tp3ratings\Domain\Model\Iplog){
            if ($ratingsdata instanceof \Tp3\Tp3ratings\Domain\Model\Ratingsdata && intval($ratingsdata->getVotecount()) > 0) {
                if($iplog instanceof \Tp3\Tp3ratings\Domain\Model\Iplog)$ratingsdata->setSubmittext($this->gettranslation('api_already_rated'));
                else{
                    $ratingsdata->setTip("update");
                    $ratingsdata->setSubmittext($this->gettranslation('api_already_thx'));
                }
            } else {
                $ratingsdata = $this->objectManager->get('Tp3\\Tp3ratings\\Domain\\Model\\Ratingsdata');
                $ratingsdata->setTip("add");
                $ratingsdata->setSubmittext($this->gettranslation('api_already_thx'));
            }
            $iplog = $this->objectManager->get('Tp3\\Tp3ratings\\Domain\\Model\\Iplog');
            $iplog->SetIp($GLOBALS["_SERVER"]["REMOTE_ADDR"]);
            //$iplog->SetRef($this->request->hasArgument("ref") ? $this->request->getArgument("ref") : $GLOBALS["TSFE"]->page["uid"]);
            $iplog->SetSession($_SESSION);
            // md5($ref . $i . $ajaxData . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
            $data_str =  $this->request->hasArgument("ratingdata") ? $this->request->getArgument("ratingdata") : '';
            $ratingsdata->setCheck( $this->request->hasArgument("check") ? $this->request->getArgument("check") : false);

            if ($data_str == '' && md5($this->request->hasArgument("ref") ? $this->request->getArgument("ref") : 0 . $this->request->getArgument("rating")? intval($this->request->getArgument("rating")):0 . base64_encode(serialize($data_str)) . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) != $ratingsdata->getCheck()) {





                $this->addFlashMessage( $this->gettranslation('wrong_check_value'));
                $ratingsdata->addSubmittext($this->gettranslation('wrong_check_value'));
            }
            else{
                $ratingsdata->setVotecount(intval($ratingsdata->getVotecount())+ 1);
                $ratingsdata->setRef( $this->request->hasArgument("ref") ? $this->request->getArgument("ref") : $GLOBALS["TSFE"]->page["uid"]);
                $ratingsdata->setPid(  $this->request->hasArgument("ref") ? $this->request->getArgument("ref") :  $GLOBALS["TSFE"]->page["uid"]);
                if (trim($ratingsdata->getRef()) == '') {
                    $this->addFlashMessage( $this->gettranslation('bad_ref_value'));
                    $ratingsdata->addSubmittext($this->gettranslation('bad_ref_value'));
                }
                $iplog->SetRef($ratingsdata);//$this->request->getArgument("id")
                //	$this->iplogRepository->findAll();
                $ratingsdata->setRating($this->request->getArgument("rating")? intval($this->request->getArgument("rating")) + $ratingsdata->getRating() : "error");
                if (!intval($ratingsdata->getRating())) {
                    $this->addFlashMessage( $this->gettranslation('bad_rating_value'));
                    $ratingsdata->addSubmittext($this->gettranslation('bad_rating_value'));
                }
                if(intval($ratingsdata->getUid())> 0)$this->ratingsdataRepository->update($ratingsdata);
                else {
                    $this->ratingsdataRepository->add($ratingsdata);

                }
                $this->iplogRepository->add($iplog);
                //$ratingsdata->setSubmittext($this->controllerContext->getFlashMessageQueue());
                $this->persistenceManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
                $this->persistenceManager->persistAll();;
            }

        }
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $Ratings */
        $infoWindowView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        // Dateiformat festlegen
        $infoWindowView->setFormat('json');
        //$this->conf = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

        // Typoscript-Konfiguration fuer entsprechendes Template holen
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->conf['view']['templateRootPath']);

        // Template-Pfad festlegen bzw. entsprechend anpassen
        $templatePathAndFilename = $templateRootPath . 'Ratingsdata/Rating.json';

        if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getExtensionVersion('extbase')) < 8007000) {

            $infoWindowView->setTemplatePathAndFilename($templatePathAndFilename);
        } else {
            $layoutRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->conf['view']['layoutRootPath']);
            $partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->conf['view']['partialRootPath']);
         //   $infoWindowView->setRenderingContext()
            $infoWindowView->setLayoutRootPaths(array($templateRootPath.'Ratingsdata/Layouts/',$layoutRootPath));
            $infoWindowView->setPartialRootPaths(array($partialRootPath));
            $infoWindowView->setTemplatePathAndFilename($templatePathAndFilename);
        }
        //	$infoWindowView->setLayoutName("Rating");
        // Objekt �bergeben und Template verarbeiten
        $infoWindowView->assign('ratingsdata', $ratingsdata);

        // Rendern und zurueckgeben
        $infoWindow = $infoWindowView->render();
        return $infoWindow;
        //$this->redirect('list');
    }
    /**
     * action create
     *
     * @param \Tp3\Tp3ratings\Domain\Model\Ratingsdata $newRatingsdata
     * @return void
     */
    public function createAction(\Tp3\Tp3ratings\Domain\Model\Ratingsdata $newRatingsdata)
    {
      //  $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->ratingsdataRepository->add($newRatingsdata);
        $this->redirect('list');
    }
    /**
     * This method assigns some default variables to the view
     */
    private function setDefaultViewVars() {
        if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getExtensionVersion('extbase')) >= 1003000) {
            $cObjData = $this->configurationManager->getContentObject()->data;
        } else {
            $cObjData = $this->request->getContentObjectData();
        }
        $this->extKey = "tp3ratings";
        $this->conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']["tx_".strtolower($this->extKey)]);
        //	$this->layout = $this->settings["layout"] ? $this->settings["layout"] : "style05";
        $this->cObjRenderer = new \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer();
        $configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        $this->conf = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $this->pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Page\\PageRenderer');
        $this->view->assign('cObjData', $cObjData);
    }
    /**
     * action translate
     *
     * @return string
     */

    private function gettranslation($key){
        //$extensionName = "Tp3share";
        $trans = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate( $key, $this->extKey);
        return $trans != "" ? $trans : "keine translation";
    }
}