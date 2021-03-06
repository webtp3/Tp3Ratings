<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3ratings\Tests\Unit\Domain\Model;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 *
 */
class RatingsdataTest extends UnitTestCase
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
            5,
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
            1,
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
            0,
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
