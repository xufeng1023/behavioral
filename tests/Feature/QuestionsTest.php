<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    public function test_unauthenticated_redirect_login_page()
    {
    	$this->get('home')->assertRedirect('/login');
    }

    public function test_save_answer_validation()
    {
    	$this->login();
    	$keys = ['quest_sleep','quest_day','quest_meal'];
    	$this->post('/questions', array_fill_keys($keys, null))
    		->assertSessionHasErrors($keys);
    }

    public function test_an_authenticated_user_can_only_see_his_own_answers()
    {
    	$myAnswer = $this->question(['user_id' => $this->login()]);
    	$notMyAnswer = $this->question();
    	$this->get('/home')
    		->assertSee($myAnswer->user->name)
    		->assertDontSee($notMyAnswer->user->name);
    }
}
