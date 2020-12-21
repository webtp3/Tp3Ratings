<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

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
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    public $ref = null;

    /**
     * ratingvalue
     *
     * @var string
     */
    protected $ratingvalue = '';

    /**
     * Returns the ratingvalue
     *
     * @return string $ratingvalue
     */
    public function getRatingvalue()
    {
        return $this->ratingvalue;
    }

    /**
     * Sets the ratingvalue
     *
     * @param string $ratingvalue
     * @return void
     */
    public function setRatingvalue($ratingvalue)
    {
        $this->ratingvalue = $ratingvalue;
    }

    /**
     * cruser_id
     *
     * @var string
     */
    protected $cruser_id = '';

    /**
     * Returns the cruser_id
     *
     * @return string $cruser_id
     */
    public function getCruserId()
    {
        return $this->cruser_id;
    }

    /**
     * Sets the cruser_id
     *
     * @param string $cruser_id
     * @return void
     */
    public function setCruserId($cruser_id)
    {
        $this->cruser_id = $cruser_id;
    }

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
     * crdate
     *
     * @var string
     */
    protected $crdate = '';

    /**
     * Returns the crdate
     *
     * @return string $crdate
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * Sets the crdate
     *
     * @param string $crdate
     * @return void
     */
    public function setCrdate($crdate)
    {
        $this->crdate = $crdate;
    }
    /**
     * userid
     *
     * @var string
     */
    protected $userid = '';

    /**
     * Returns the userid
     *
     * @return string $userid
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Sets the userid
     *
     * @param string $userid
     * @return void
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * review
     *
     * @var string
     */
    protected $review = '';

    /**
     * Returns the review
     *
     * @return string $review
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Sets the review
     *
     * @param string $review
     * @return void
     */
    public function setReview($review)
    {
        $this->review = $review;
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
