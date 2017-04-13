<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Http\Requests\StoreAnswer;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    protected $answer;

    public function __construct(Answers $answer)
    {
        $this->answer = $answer;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return $this->answer->month($request);
    }

    public function store(StoreAnswer $request)
    {   
        $this->answer->saveOrUpdateToday($request);
        return back();
    }
}
