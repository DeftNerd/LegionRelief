<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Tip;       

class TipTest extends TestCase
{     
      
  use DatabaseMigrations;

  public function testCanInstantiateTip()
  {   
      
    $tip = new Tip;      

    $this->assertEquals(get_class($tip), 'App\Tip');

  }
  
  public function testCanInsertRecord()
  {

      $tipFactory = factory('App\Tip')->create();

      $tips = Tip::all();

      $this->assertEquals($tips->count(), 1);

  }

}