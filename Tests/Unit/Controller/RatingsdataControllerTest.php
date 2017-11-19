<?php
namespace Tp3\Tp3ratings\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Thomas Ruta <email@thomasruta.de>
 */
class RatingsdataControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Tp3\Tp3ratings\Controller\RatingsdataController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Tp3\Tp3ratings\Controller\RatingsdataController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllRatingsdatasFromRepositoryAndAssignsThemToView()
    {

        $allRatingsdatas = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $ratingsdataRepository = $this->getMockBuilder(\Tp3\Tp3ratings\Domain\Repository\RatingsdataRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $ratingsdataRepository->expects(self::once())->method('findAll')->will(self::returnValue($allRatingsdatas));
        $this->inject($this->subject, 'ratingsdataRepository', $ratingsdataRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('ratingsdatas', $allRatingsdatas);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRatingsdataToView()
    {
        $ratingsdata = new \Tp3\Tp3ratings\Domain\Model\Ratingsdata();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('ratingsdata', $ratingsdata);

        $this->subject->showAction($ratingsdata);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenRatingsdataToRatingsdataRepository()
    {
        $ratingsdata = new \Tp3\Tp3ratings\Domain\Model\Ratingsdata();

        $ratingsdataRepository = $this->getMockBuilder(\Tp3\Tp3ratings\Domain\Repository\RatingsdataRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $ratingsdataRepository->expects(self::once())->method('add')->with($ratingsdata);
        $this->inject($this->subject, 'ratingsdataRepository', $ratingsdataRepository);

        $this->subject->createAction($ratingsdata);
    }
}
