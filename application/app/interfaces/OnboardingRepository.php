<?php 

namespace App\Interfaces;

interface OnboardingRepository 
{
	public function getWeekOneCohort();
	public function getWeekTwoCohort();
	public function getWeekThreeCohort();
	public function getWeekFourCohort();
}