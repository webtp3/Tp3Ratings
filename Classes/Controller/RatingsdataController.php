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
use TYPO3\CMS\Core\Error\Http\PageNotFoundException;
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
     *
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
    public $tp3reviewdata = '';
    /**
     * @var string
     */
    protected $entityNotFoundMessage = 'The requested entity could not be found.';
    /**
     * @var string
     */
    protected $unknownErrorMessage = 'An unknown error occurred. The wild monkey horde in our basement will try to fix this as soon as possible.';

    /**
     *
     * Override actions for page
     * common.
     *
     * @api
     */
    protected function initializeAction()
    {
        $actionMethodName = $this->request->getControllerActionName();

    }

    /**
     * Generates HTML code for displaying ratings.
     *
     * @param	string		$ref	Reference
     * @param	array		$conf	Configuration array
     * @return	string		HTML content
     */
    public function getRatingDisplay() {
        $rating = $this->ratingsdataRepository->findbyStorgePid($GLOBALS["TSFE"]->page["uid"])->getFirst();
        if ($rating instanceof \Tp3\Tp3ratings\Domain\Model\Ratingsdata && $rating->getVotecount() > 0) {
            $rating_value = $rating->getRating()/$rating->getVotecount();
        } else {
            $rating = $this->objectManager->get('Tp3\\Tp3ratings\\Domain\\Model\\Ratingsdata');
            $rating_value = 0;
            //$rating_str = $language->sL('LLL:EXT:tp3ratings/Resources/Private/Language/locallang.xml:api_not_rated');
        }

        $data = serialize(array(
            'pid' => $GLOBALS["TSFE"]->page["uid"],
            'conf' => $this->settings,
            'lang' => $GLOBALS['TSFE']->lang,
        ));
        if ($ref == "")$ref=$GLOBALS["TSFE"]->page["uid"];
        $ajaxData = base64_encode($data);
        // Create links
        $links = '';

        for ($i = $this->settings['minValue']; $i <= $this->settings['maxValue']; $i++) {
            $check = md5($ref . $i . $ajaxData . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
            $rating->SetOptions( array(
                'value' => intval($i),
                'ref' => $ref,
                'pid' => $GLOBALS["TSFE"]->page["uid"],
                'check' => $check,
                'vrating' => intval(round( $rating->getRating()/$rating->getVotecount()*100)),
                'rating'=> intval(round( $rating->getRating())),
                'ratingdata' => rawurlencode($ajaxData),
            ));
        }


        return $rating;
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
            if($request->hasArgument("check")){
               if($request->getArgument("check") == md5($_REQUEST["ref"] . $_REQUEST["rating"] . $data_str . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'])){
                   $request->SetArgument("check",$request->getArgument("check"));
                   $request->SetArgument("ratingdata", unserialize(base64_decode($data_str)));
               }
                  //  throw InvalidPropertyException;

            }
            else{
               // throw PageNotFoundException;
            }
        }
        if (count($request->getArguments())> 0 &&  $request->getArgument("eID") == "review" && $request->hasArgument("tp3reviewdata") ) {
            //&& $this->resolveActionMethodName() == "ratingAction"
            $this->tp3reviewdata = $request->getArgument("tp3reviewdata");
           // $request->SetArgument("ratingdata", unserialize(base64_decode($data_str)));
            if($request->hasArgument("check"))$request->SetArgument("check",$request->getArgument("check"));
            else{
              //  throw PageNotFoundException;
            }
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
        $langflip = $this->gettranslation('api_rating');
        $this->view->assign('ratingstext', sprintf($langflip,$ratingsdatas->getRating()/$ratingsdatas->getVotecount(),$this->settings["maxValue"], $ratingsdatas->getVotecount()));

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
        if (preg_match('/^\d{2,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $remoteaddress =  $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else $remoteaddress =$_SERVER['REMOTE_ADDR'];
        $iplog = $this->iplogRepository->findbyIpandRef($remoteaddress,$GLOBALS["TSFE"]->page["uid"], $GLOBALS["TSFE"]->fe_user->id)->getFirst();
        // $this->settings["disableIpCheck"] = 1;
        if($this->settings["disableIpCheck"] == 1 || !$iplog instanceof \Tp3\Tp3ratings\Domain\Model\Iplog){
            if ($ratingsdata instanceof \Tp3\Tp3ratings\Domain\Model\Ratingsdata && intval($ratingsdata->getVotecount()) > 0) {
                if($iplog instanceof \Tp3\Tp3ratings\Domain\Model\Iplog){
                    $ratingsdata->setTip("update");
                    $ratingsdata->setSubmittext($this->gettranslation('api_already_thx'));
                }
                else{
                    $ratingsdata->setTip("update");
                    $iplog = $this->objectManager->get('Tp3\\Tp3ratings\\Domain\\Model\\Iplog');
                    $ratingsdata->setSubmittext($this->gettranslation('api_already_thx'));
                }
            } else {
                $ratingsdata = $this->objectManager->get('Tp3\\Tp3ratings\\Domain\\Model\\Ratingsdata');
                $ratingsdata->setTip("add");
                $ratingsdata->SetObj($this->settings["pageObjectName"]);
                $ratingsdata->setSubmittext($this->gettranslation('api_already_thx'));
            }
            if(!$iplog instanceof \Tp3\Tp3ratings\Domain\Model\Iplog)   $iplog = $this->objectManager->get('Tp3\\Tp3ratings\\Domain\\Model\\Iplog');


            $iplog->setIp($remoteaddress);
            if($ratingsdata->obj == "pages" ) {
                $iplog->setPid(  $this->request->hasArgument("ref") ? $this->request->getArgument("ref") :  $GLOBALS["TSFE"]->page["uid"]);
            }
            else{
                $iplog->setPid(  $GLOBALS["TSFE"]->domainStartPage ?  $GLOBALS["TSFE"]->domainStartPage :  $GLOBALS["TSFE"]->page["uid"]);

            }
            $iplog->SetSession($GLOBALS["TSFE"]->fe_user->id);
            $data_str =  $this->request->hasArgument("ratingdata") ? $this->request->getArgument("ratingdata") : '';
            $ratingsdata->setCheck( $this->request->hasArgument("check") ? $this->request->getArgument("check") : false);

            if ($data_str == '' && md5($this->request->hasArgument("ref") ? $this->request->getArgument("ref") : 0 . $this->request->getArgument("rating")? intval($this->request->getArgument("rating")):0 . base64_encode(serialize($data_str)) . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) != $ratingsdata->getCheck()) {
                $this->addFlashMessage( $this->gettranslation('wrong_check_value'));
                $ratingsdata->addSubmittext($this->gettranslation('wrong_check_value'));
            }
            else{
                $ratingsdata->setVotecount(intval($ratingsdata->getVotecount())+ 1);
                $ratingsdata->setRef( $this->request->hasArgument("ref") ? $this->request->getArgument("ref") : $GLOBALS["TSFE"]->page["uid"]);
              if($ratingsdata->obj == "pages" ) {
                  $ratingsdata->setPid(  $this->request->hasArgument("ref") ? $this->request->getArgument("ref") :  $GLOBALS["TSFE"]->page["uid"]);
              }
              else{
                  $ratingsdata->setPid(   $GLOBALS["TSFE"]->domainStartPage ?  $GLOBALS["TSFE"]->domainStartPage :  $GLOBALS["TSFE"]->page["uid"]);

              }
                if (trim($ratingsdata->getRef()) == '') {
                    $this->addFlashMessage( $this->gettranslation('bad_ref_value'));
                    $ratingsdata->addSubmittext($this->gettranslation('bad_ref_value'));
                }
                $iplog->SetRef($ratingsdata);//$this->request->getArgument("id")
                //	$this->iplogRepository->findAll();
                $iplog->setRatingvalue($this->request->getArgument("rating")? intval($this->request->getArgument("rating")):0);
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
        $infoWindowView->assign('disableReview', $this->settings["disableReview"]);
        $infoWindowView->assign('ratingsdata', json_encode($ratingsdata->_getCleanProperties()));
        $infoWindowView->assign('settings', $this->settings);
        // Rendern und zurueckgeben
        $infoWindow = $infoWindowView->render();
        return $infoWindow;
        //$this->redirect('list');
    }

    /**
     * action review
     *
     *
     * @return void
     */
    public function ReviewAction()
    {
        $this->setDefaultViewVars();
        if (preg_match('/^\d{2,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $remoteaddress =  $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else $remoteaddress =$_SERVER['REMOTE_ADDR'];
        $iplog = $this->iplogRepository->findbyIpandRef($remoteaddress,$GLOBALS["TSFE"]->page["uid"], $GLOBALS["TSFE"]->fe_user->id)->getFirst();

            if(!$iplog instanceof \Tp3\Tp3ratings\Domain\Model\Iplog){
                $iplog = $this->objectManager->get('Tp3\\Tp3ratings\\Domain\\Model\\Iplog');
                $iplog->setIp($remoteaddress);
                if($iplog->ref->getObj() == "pages" ) {
                    $iplog->setPid(  $this->request->hasArgument("ref") ? $this->request->getArgument("ref") :  $GLOBALS["TSFE"]->page["uid"]);
                }
                else{
                    $iplog->setPid(  $GLOBALS["TSFE"]->domainStartPage ?  $GLOBALS["TSFE"]->domainStartPage :  $GLOBALS["TSFE"]->page["uid"]);

                }

            }
            $iplog->ref->setReviewCount($iplog->ref->getReviewCount()+1);
            $iplog->setReview(is_string($this->tp3reviewdata["review"]));
            $iplog->setUserid(is_string ($this->tp3reviewdata["emailadresse"]));
            $iplog->SetSession($GLOBALS["TSFE"]->fe_user->id);
            /*
             *   $GLOBALS['TSFE']->fe_user->user = $GLOBALS['TSFE']->fe_user->fetchUserSession();
                        $GLOBALS['TSFE']->loginUser = 1;
             */
       if($GLOBALS['TSFE']->loginUser) $iplog->setCruserId(  $GLOBALS['TSFE']->fe_user->getUid());


                if(intval($iplog->getUid())> 0){
                    $this->ratingsdataRepository->update($iplog->ref);
                    $this->iplogRepository->update($iplog);

                }
                else {
                  //  $this->ratingsdataRepository->add($ratingsdata);
                    $this->iplogRepository->add($iplog);


                }
                //$ratingsdata->setSubmittext($this->controllerContext->getFlashMessageQueue());
                $this->persistenceManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
                $this->persistenceManager->persistAll();;





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
        $infoWindowView->assign('disableReview', $this->settings["disableReview"]);
        $infoWindowView->assign('ratingsdata', json_encode($this->tp3reviewdata));
        $infoWindowView->assign('settings', $this->settings);
        // Rendern und zurueckgeben
        $infoWindow = $infoWindowView->render();
        return $infoWindow;
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
     //   $this->conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']["tx_".strtolower($this->extKey)]);
        //	$this->layout = $this->settings["layout"] ? $this->settings["layout"] : "style05";
        $this->cObjRenderer = new \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer();
        $configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        $this->conf = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK , $this->extensionName);
        $this->pageRenderer = $this->objectManager->get('TYPO3\\CMS\\Core\\Page\\PageRenderer');
        $this->view->assign('cObjData', $cObjData);
        $this->view->assign('debugMode', false);


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