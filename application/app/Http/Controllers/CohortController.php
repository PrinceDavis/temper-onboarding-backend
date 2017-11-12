<?php

namespace App\Http\Controllers;

use App\Onboarding;

class CohortController extends Controller
{
    
    public function index()
    {   
        $onboarding = new Onboarding();
        return [
            'week1' => $onboarding->getWeekOneCohort(),
            'week2' => $onboarding->getWeekTwoCohort(),
            'week3' => $onboarding->getWeekThreeCohort(),
            'week4' => $onboarding->getWeekFourCohort()
        ];
    }
}
