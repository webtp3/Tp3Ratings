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
 * Ratingsdata
 */
class Ratingsdata extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
 /**
     * rating
     *
     * @var integer
     */
    protected $rating = 5;

    /**
     * votecount
     *
     * @var string
     */
    protected $votecount = 1;

    /**
     * ref
     *
     * @var string
     */
    protected $ref = 0;
	
    /**
     * tip
     *
     * @var string
     */
    protected $tip = '';

    /**
     * options
     *
     * @var array
     */
    protected $options = array();

    /**
     * votelink
     *
     * @var string
     */
    protected $votelink = '';
    
    /**
     * barwidth
     *
     * @var string
     */
    protected $barwidth = '100';
    
    /**
     * worstRating
     *
     * @var string
     */
    protected $worstRating = 1;
    
    /**
     * ratingValue
     *
     * @var string
     */
    protected $ratingValue= '';
    
    /**
     * reviewCount
     *
     * @var string
     */
    protected $reviewCount = '';
    /**
     * ratingCount
     *
     * @var string
     */
    protected $ratingCount= '';
    
    /**
     * bestRating
     *
     * @var string
     */
    protected $bestRating = 5;
    
    
     /**
     * submittext
     *
     * @var string 
     */
    protected $submittext = '';

    /**
     * submittext
     *
     * @var string
     */
    protected $check = '';

    /**
     * tip
     *
     * @var string
     */
    public function getTip()
    {
    	return $this->tip;
    }

    /**
     * tip
     *
     * @param string $tip
     * @return void
     */
    public function setTip($tip)
    {
        return $this->tip = $tip;
    }
    /**
     * votelink
     *
     * @var string
     */
    public function getVotelink()
    {
    	return $this->votelink;
    }
    
    /**
     * ref
     *
     * @var barwidth
     */
    public function getBarwidth()
    {
    	return $this->barwidth;
    }
    
    /**
     * worstRating
     *
     * @var string
     */
    public function getWorstRating()
    {
    	return $this->worstRating;
    }
    /**
     * initaction
     *
     * @return void
     */
    public function __construct()
    {
       // $this->
    }

    /**
     * ratingValu
     *
     * @var string
     */
    public function getRatingValue()
    {
    	return round($this->rating / $this->votecount,2);
    }
    
    /**
     * reviewCount
     *
     * @var string
     */
    public function getReviewCount()
    {
        return $this->votecount;
    }
    /**
     * ratingCount
     *
     * @var string
     */
    public function getRatingCount()
    {
    	return $this->votecount;
    }
    
    /**
     * bestRating
     *
     * @var string
     */
    public function getBestRating()
    {
    	return $this->bestRating;
    }
    
    /**
     * submittext
     *
     * @var string
     */
    public function getSubmittext()
    {
    	return $this->submittext;
    }
    /**
     * submittext
     *
     * @var string $submittext
     * @return void
     */
    public function setSubmittext($submittext)
    {
        return $this->submittext = $submittext;
    }
    /**
     * submittext
     *
     * @var string $submittext
     * @return void
     */
    public function addSubmittext($submittext)
    {
        return $this->submittext .= " & " . $submittext;
    }

    /**
     * Returns the rating
     *
     * @return string $rating
     */
     public function getRating()
    {
        return $this->rating;
    }

    /**
     * Sets the rating
     *
     * @param string $rating
     * @return void
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
    /**
     * Returns the check
     *
     * @return string $check
     */
    public function getCheck()
    {
        return $this->check;
    }

    /**
     * Sets the check
     *
     * @param string $check
     * @return void
     */
    public function setCheck($check)
    {
        $this->check = $check;
    }

    /**
     * Returns the options
     *
     * @return array $options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the options
     *
     * @param array $options
     * @return void
     */
    public function setOptions($options)
    {
        $this->options[] = $options;
    }

    /**
     * Returns the votecount
     *
     * @return string $votecount
     */
    public function getVotecount()
    {
        return $this->votecount;
    }

    /**
     * Sets the votecount
     *
     * @param string $votecount
     * @return void
     */
    public function setVotecount($votecount)
    {
        $this->votecount = $votecount;
    }

    /**
     * Returns the ref
     *
     * @return string $ref
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Sets the ref
     *
     * @param string $ref
     * @return void
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }
}
