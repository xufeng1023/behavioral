<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quest_sleep' => 'integer|between:6,10',
            'quest_day' => 'in:bad,ok,good,great',
            'quest_meal' => 'integer|between:0,4'
        ];
    }

    public function messages()
    {
        return [
            'quest_sleep.integer' => 'How many hours exactly?',
            'quest_sleep.between' => 'How many hours exactly?',
            'quest_day.in' => 'How was your day again?',
            'quest_meal.integer' => 'Please answer the question seriously',
            'quest_meal.between' => 'Please answer the question seriously'
        ];
    }
}
