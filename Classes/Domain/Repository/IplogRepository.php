<?php
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
     * @param integer $catUID
     * @return Tp3\Tp3ratings\Domain\Model\Iplog
     */
    public function findbyIpandRef($ip, $pid) {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(false);

        $this->setDefaultQuerySettings($querySettings);
        $query = $this->createQuery();
        $query->matching(
            $query->equals('ip', $ip),
            $query->logicalAnd(
                $query->equals('hidden', 0),
                $query->equals('ref', $pid),
                $query->equals('deleted', 0)
            )
        );
        return $query->execute();
    }
    }
