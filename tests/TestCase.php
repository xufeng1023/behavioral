<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    private function create($model, $attr = [])
    {
    	return factory("App\\$model")->create($attr);
    }

    protected function answer($attr = [])
    {
    	return $this->create('Answers', $attr);
    }

    protected function user($attr = [])
    {
    	return $this->create('User', $attr);
    }

    protected function login()
    {
    	$this->be($user = $this->user());
    	return $user->id;
    }
}
