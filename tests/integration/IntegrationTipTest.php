<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IntegrationTipTest extends TestCase
{

    use DatabaseMigrations;

    public function testAuthenticatedUserCanSubmitTip()
    {
        $user = factory(App\User::class)->create();

        $catA = factory(App\Category::class)->create();
        $catB = factory(App\Category::class)->create();
        $catC = factory(App\Category::class)->create();

        $cats = join(',', [$catA->id, $catB->id, $catC->id]);

        $this->actingAs($user)
             ->visit('/tips/create')
             ->type('Some Example Tip Title', 'name')
             ->type('Some example tip oneline description', 'oneline')
             ->type('Some **Markdown* text', 'description')
             ->type($cats, 'categories')
             ->press('Submit Tip')
             ->seePageIs('/tips/some-example-tip-title');

    }

}