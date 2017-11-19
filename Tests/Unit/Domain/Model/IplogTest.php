<?php
namespace Tp3\Tp3ratings\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Thomas Ruta <email@thomasruta.de>
 */
class IplogTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Tp3\Tp3ratings\Domain\Model\Iplog
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Tp3\Tp3ratings\Domain\Model\Iplog();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getIpReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getIp()
        );

    }

    /**
     * @test
     */
    public function setIpForStringSetsIp()
    {
        $this->subject->setIp('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'ip',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getRefReturnsInitialValueForRatingsdata()
    {
        self::assertEquals(
            null,
            $this->subject->getRef()
        );

    }

    /**
     * @test
     */
    public function setRefForRatingsdataSetsRef()
    {
        $refFixture = new \Tp3\Tp3ratings\Domain\Model\Ratingsdata();
        $this->subject->setRef($refFixture);

        self::assertAttributeEquals(
            $refFixture,
            'ref',
            $this->subject
        );

    }
}
