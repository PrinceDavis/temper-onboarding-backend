<?php
use App\Onboarding;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CohortTest extends TestCase
{
	public function setUp()
  {
    parent::setUp();
    $this->onboarding = new Onboarding();
  }

  /** @test */
  public function should_return_week1_cohort()
  {
    $this->get('/cohorts');

    $this->seeJson([
    	'week1' => $this->onboarding->getWeekOneCohort()
    ]);
  }

  /** @test */
  public function should_return_week2_cohort()
  {
  	$this->get('/cohorts');

    $this->seeJson([
    	'week2' => $this->onboarding->getWeekTwoCohort()
    ]);
  }


  /** @test */
  public function should_return_week3_cohort()
  {
  	$this->get('/cohorts');

    $this->seeJson([
    	'week3' => $this->onboarding->getWeekThreeCohort()
    ]);
  }

  /** @test */
  public function should_return_week4_cohort()
  {
  	$this->get('/cohorts');

    $this->seeJson([
    	'week4' => $this->onboarding->getWeekFourCohort()
    ]);
  }
}