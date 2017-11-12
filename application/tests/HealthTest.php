<?php
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class HealthTest extends TestCase
{
    /** @test */
    public function application_is_heathy()
    {
      $this->get('/');

      $this->assertEquals(
        'welcome to onboarding analytics api', $this->response->getContent()
      );
    }
}
