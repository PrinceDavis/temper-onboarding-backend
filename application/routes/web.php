<?php

use App\Onboarding;

$router->get('/', function () use ($router) {
  return 'welcome to onboarding analytics api';
});
$router->get('/cohorts', 'CohortController@index');
  
