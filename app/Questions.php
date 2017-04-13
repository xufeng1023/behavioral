<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
	protected $guarded = [];

	protected $dateFormat = 'Y-m-d';

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function scopeToday($query)
    {
    	return $query->where('created_at', date('Y-m-d'));
    }

    public function scopeMonth($query, $request)
    {
    	return $query->where('created_at', 'like', "$request->date%")
    				->select(["quest_$request->cat", 'created_at']);
    }
}
