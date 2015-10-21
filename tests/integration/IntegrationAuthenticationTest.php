<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IntegrationAuthenticationTest extends TestCase
{

    use DatabaseMigrations;

    public function testUnauthenticatedUserCantSeeSubmitLegionnaireForm()
    {
        $this->visit('/')
             ->click('legionnaire-submit')
             ->seePageIs('/login');
    }

    public function testAuthenticatedUserCanSeeSubmitLegionnaireForm()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/')
             ->click('legionnaire-submit')
             ->see('Submit a Legionnaire');
    }

    public function testAuthenticatedUserCanSeeHisName()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/')
             ->see('Hi, ' . $user->name);
    }

}
