<?php

use App\Onboarding;

class OnboardingUnitTest extends TestCase
{
	protected $onboarding;

	public function setUp()
  {
    parent::setUp();
    $this->onboarding = new Onboarding();
  }

	/** @test */
	public function content_is_not_empty()
	{
		$this->assertNotEmpty($this->onboarding->getContent());
	}

	/** @test */
	public function content_is_of_the_right_size()
	{
		$this->assertEquals(
			339, count($this->onboarding->getContent())
		);
	}

	/** @test */
	public function cohort_week1_is_of_right_size()
	{
		$this->assertEquals(
			112,
			count(
				$this->onboarding->findCohortBetween(
					$this->onboarding->begining_of_week1,
					$this->onboarding->end_of_week1
				)
			)
		);
	}

	/** @test */
	public function cohort_week2_is_of_right_size()
	{
		$this->assertEquals(
			134,
			count(
				$this->onboarding->findCohortBetween(
					$this->onboarding->begining_of_week2,
					$this->onboarding->end_of_week2
				)
			)
		);
	}

	/** @test */
	public function cohort_week3_is_of_right_size()
	{
		$this->assertEquals(
			61,
			count(
				$this->onboarding->findCohortBetween(
					$this->onboarding->begining_of_week3,
					$this->onboarding->end_of_week3
				)
			)
		);
	}

	/** @test */
	public function cohort_week4_is_of_right_size()
	{
		$this->assertEquals(
			32,
			count(
				$this->onboarding->findCohortBetween(
					$this->onboarding->begining_of_week4,
					$this->onboarding->end_of_week4
				)
			)
		);
	}
}