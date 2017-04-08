<?php

namespace Tests\Feature;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    public function test_login()
    {
        $note = factory('App\Questions')->create();
        $this->be($note->user);
        $response = $this->get('/home');

        $response->assertSee($note->quest_day);
    }
}
