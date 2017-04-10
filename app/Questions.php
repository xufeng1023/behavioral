<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
	protected $fillable = ['quest_sleep','quest_day','quest_meal'];
	
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
