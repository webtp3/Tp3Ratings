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
 * The repository for Ratingsdatas
 */
class RatingsdataRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     *
     *
     * @param int $catUID
     * @return Tp3\Tp3ratings\Domain\Model\Ratingsdata
     */
    public function findbyStorgePid($customStoragePid)
    {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(false);
        //$querySettings->setStoragePageIds(array($customStoragePid));
        $this->setDefaultQuerySettings($querySettings);
        //$queryResult = $this->findAll();
        //return $queryResult;*/
        $query = $this->createQuery();
        $query->matching(
            $query->equals('ref', $customStoragePid),
            $query->logicalAnd(
                $query->equals('hidden', 0),
                $query->equals('deleted', 0)
            )
        );
        //$query->setOrderings($this->orderByField('uid', $uidArray));
        return $query->execute();
    }
}
