<?php

use App\Onboarding;

$router->get('/', function () use ($router) {
  return 'welcome to analytics api';
});

$router->get('/data', function () use ($router) {
	$onboarding = new Onboarding();
    // return $onboarding->getWeekOneCohort();
    // return $onboarding->getWeekTwoCohort();
    // return $onboarding->getWeekThreeCohort();
    return $onboarding->getWeekFourCohort();
});
  
