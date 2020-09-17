<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3ratings\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 */
class RatingsdataTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Tp3\Tp3ratings\Domain\Model\Ratingsdata
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Tp3\Tp3ratings\Domain\Model\Ratingsdata();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getRatingReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getRating()
        );
    }

    /**
     * @test
     */
    public function setRatingForStringSetsRating()
    {
        $this->subject->setRating('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'rating',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getVotecountReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getVotecount()
        );
    }

    /**
     * @test
     */
    public function setVotecountForStringSetsVotecount()
    {
        $this->subject->setVotecount('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'votecount',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRefReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getRef()
        );
    }

    /**
     * @test
     */
    public function setRefForStringSetsRef()
    {
        $this->subject->setRef('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'ref',
            $this->subject
        );
    }
}
