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

/**
 * IplogController
 */
class IplogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * iplogRepository
     * 
     * @var \Tp3\Tp3ratings\Domain\Repository\IplogRepository
     * @inject
     */
    protected $iplogRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $cObj = $this->configurationManager->getContentObject();

       $this->conf = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

        $filter = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Tp3\Tp3ratings\Plugin\IplogReviews::class)->main($cObj,$this->conf);

        $iplogs = $this->iplogRepository->getList($filter);
        $this->view->assign('debugMode', $this->conf["debugMode"]);
        $this->view->assign('tp3reviewdata', $iplogs);
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
     * action create
     * 
     * @param \Tp3\Tp3ratings\Domain\Model\Iplog $newIplog
     * @return void
     */
    public function createAction(\Tp3\Tp3ratings\Domain\Model\Iplog $newIplog)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->iplogRepository->add($newIplog);
        $this->redirect('list');
    }
}
