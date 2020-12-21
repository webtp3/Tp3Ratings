<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3ratings\Domain\Repository;

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
 * The repository for Iplogs
 */
class IplogRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     *
     *
     * @param int $catUID
     * @return Tp3\Tp3ratings\Domain\Model\Iplog
     */
    public function findbyIpandRef($ip, $pid, $sessid = '')
    {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(false);

        $this->setDefaultQuerySettings($querySettings);
        $query = $this->createQuery();
        $query->matching(
            $query->equals('ip', $ip),
//            $query->equals('hidden', 0),
            $query->logicalAnd(
                $query->equals('hidden', 0),
                $query->equals('ref', $pid),
                $query->equals('session', $sessid),
                $query->equals('deleted', 0)
            )
        );
        return $query->execute();
    }
    /**
     *
     *
     * @param int $catUID
     * @return Tp3\Tp3ratings\Domain\Model\Iplog
     */
    public function findFeUserEmail($email, $pid)
    {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(false);

        $this->setDefaultQuerySettings($querySettings);
        $query = $this->createQuery();
        $query->matching(
            $query->equals('userid', $email),
            $query->logicalAnd(
                $query->equals('hidden', 0),
                $query->equals('ref', $pid),
                $query->equals('deleted', 0)
            )
        );
        return $query->execute();
    }

    /**
     *
     *
     * @param int $list
     * @return Tp3\Tp3ratings\Domain\Model\Iplog
     */
    public function getList($list = null)
    {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setStoragePageIds([$GLOBALS['TSFE']->domainStartPage]);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
        $uids = explode(',', $list[1]);
        if ($list != null) {
            $uids = explode(',', $list[1]);
            $refs = explode(',', $list[0]);
        }

        if (is_array($uids) && is_array($refs)) {
            $query = $this->createQuery();
            $query->matching(
                $query->in('uid', $uids),
                $query->in('ref', $refs),
                $query->logicalAnd(
                    $query->equals('hidden', 0),
                    $query->equals('deleted', 0)
                )
            );
        } elseif (is_array($uids)) {
            $query = $this->createQuery();
            $query->matching(
                $query->in('uid', $uids),
                $query->logicalAnd(
                    $query->equals('hidden', 0),
                    $query->equals('deleted', 0)
                )
            );
        } elseif (is_array($refs)) {
            $query = $this->createQuery();
            $query->matching(
                $query->in('ref', $refs),
                $query->logicalAnd(
                      $query->equals('hidden', 0),
                      $query->equals('deleted', 0)
                  )
            );
        } else {
            $query = $this->createQuery();
            $query->matching(
                $query->greaterThan('review', ''),
                $query->logicalNot(
                    $query->equals('hidden', 1),
                    $query->equals('review', ''),
                    $query->equals('deleted', 1)
                )
            );
        }

        return $query->execute();
    }
}
