<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IntegrationLegionnaireTest extends TestCase
{

    use DatabaseMigrations;

    public function testAuthenticatedUserCanSubmitLegionnaire()
    {
        $user = factory(App\User::class)->create();

        $catA = factory(App\Category::class)->create();
        $catB = factory(App\Category::class)->create();
        $catC = factory(App\Category::class)->create();

        $cats = join(',', [$catA->id, $catB->id, $catC->id]);

        $this->actingAs($user)
             ->visit('/legionnaires/create')
             ->type('Some Example Legionnaire Title', 'name')
             ->type('Some example legionnaire oneline description', 'oneline')
             ->type('Some **Markdown* text', 'description')
             ->type($cats, 'categories')
             ->press('Submit Legionnaire')
             ->seePageIs('/legionnaires/some-example-legionnaire-title');

    }

}
