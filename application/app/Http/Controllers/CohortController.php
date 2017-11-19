<?php

namespace App\Http\Controllers;

use App\Interfaces\OnboardingRepository;
use App\Onboarding;

class CohortController extends Controller
{   
    protected $userData;

    public function __construct(OnboardingRepository $userData)
    {
        $this->userData = $userData;
    }
    public function index()
    {   
        return [
            'week1' => $this->userData->getWeekOneCohort(),
            'week2' => $this->userData->getWeekTwoCohort(),
            'week3' => $this->userData->getWeekThreeCohort(),
            'week4' => $this->userData->getWeekFourCohort()
        ];
    }
}
