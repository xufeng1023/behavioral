<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Answers extends Model
{
	protected $guarded = [];

	protected $dateFormat = 'Y-m-d';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('user_id', function(Builder $builer) {
            $builer->where('user_id', auth()->id());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saveOrUpdateToday($request)
    {
        $this->updateOrCreate(
            [
                'user_id' => auth()->id(),
                'created_at' => $request->created_at
            ], 
            $request->all()
        );
    }

    public function scopeToday($query)
    {
    	return $query->where('created_at', date($this->dateFormat))->first();
    }

    public function scopeMonth($query, $request)
    {
    	return $query->where('created_at', 'like', "$request->date%")
    				->select(["quest_$request->cat", 'created_at'])
                    ->get();
    }
}
