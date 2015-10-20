<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FunctionalWelcomeTest extends TestCase
{

    use DatabaseMigrations;

    public function testCanSeeTheSearchInterface()
    {
        $this->visit('/')->see('Search the LaraBrain');
    }

    public function testCanSeeTheCreateAccountLink()
    {
        $this->visit('/')->see('Create Account');
    }

    public function testCantSeeTheSignOutLink()
    {
        $this->visit('/')->dontsee('Sign Out');
    }

}