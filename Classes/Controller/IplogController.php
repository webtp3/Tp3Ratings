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
        $iplogs = $this->iplogRepository->findAll();
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
