@extends('layout.main')

@section('content')

<div class="row">
        <div class="col-lg-6">
            <div class="well bs-component padding-75">
                <h2>{{ e($user->username) }} profile.</h2>
                <div><p>Questions answered: <strong>{{ $total_answered }}</strong></p></div>
                <div><p>Average score: <strong>{{ sprintf("%.0f%%", $average_score) }}</strong></p></div>    
            </div>
        </div>
</div>

@stop