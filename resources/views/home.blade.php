@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST" action="/questions">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>how many hours did you sleep last night?</label>
                            <select class="form-control" name="quest_sleep">
                                <option value="0">less than 6 hours</option>
                                <option value="1">7 hours</option>
                                <option value="2" selected="selected">8 hours</option>
                                <option value="3">9 hours</option>
                                <option value="4">more than 10 hours</option>
                            </select>
                            @include('errors.one', ['field' => 'quest_sleep'])
                        </div>
                        <div class="form-group">
                            <label>How was your day?</label>
                            <select class="form-control" name="quest_mood">
                                <option value="0">Bad</option>
                                <option value="1">Not much</option>
                                <option value="2" selected="selected">Good</option>
                                <option value="3">Great</option>
                                <option value="4">Excellent</option>
                            </select>
                            @include('errors.one', ['field' => 'quest_mood'])
                        </div>
                        <div class="form-group">
                            <label>How many meals did you eat today?</label>
                            <select class="form-control" name="quest_meal">
                                <option value="0">None</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3" selected="selected">Three</option>
                                <option value="4">Too much</option>
                            </select>
                            @include('errors.one', ['field' => 'quest_meal'])
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <chart></chart>
        </div>
    </div>
</div>
@endsection
