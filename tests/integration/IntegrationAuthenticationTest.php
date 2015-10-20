<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IntegrationAuthenticationTest extends TestCase
{

    use DatabaseMigrations;

    public function testUnauthenticatedUserCantSeeSubmitTipForm()
    {
        $this->visit('/')
             ->click('tip-submit')
             ->seePageIs('/login');
    }

    public function testAuthenticatedUserCanSeeSubmitTipForm()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/')
             ->click('tip-submit')
             ->see('Submit a Tip');
    }

    public function testAuthenticatedUserCanSeeHisName()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/')
             ->see('Hi, ' . $user->name);
    }

}