<?php
namespace Tp3\Tp3ratings\Domain\Model;

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
 * Iplog
 */
class Iplog extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * ip
     *
     * @var string
     */
    protected $ip = '';

    /**
     * ref
     *
     * @var \Tp3\Tp3ratings\Domain\Model\Ratingsdata
     */
    protected $ref = null;

    /**
     * session
     *
     * @var string
     */
    protected $session = '';



    /**
     * Returns the session
     *
     * @return string $session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Sets the session
     *
     * @param string $session
     * @return void
     */
    public function setSession($session)
    {
        $this->session = $session;
    }
    /**
     * Returns the ip
     *
     * @return string $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Sets the ip
     *
     * @param string $ip
     * @return void
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Returns the ref
     *
     * @return \Tp3\Tp3ratings\Domain\Model\Ratingsdata $ref
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Sets the ref
     *
     * @param \Tp3\Tp3ratings\Domain\Model\Ratingsdata $ref
     * @return void
     */
    public function setRef(\Tp3\Tp3ratings\Domain\Model\Ratingsdata $ref)
    {
        $this->ref = $ref;
    }
}
