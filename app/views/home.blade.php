@extends('layout.main')

@section('content')

<div class="row absolute center">
    <div class="col-lg-12">
        <div class="alert alert-info center padding-100">
            <h2>{{ 'Capitals of the World Quiz' }}</h2><br>
            <h4>Start a Quiz:</h4>
        <div>
            <form action="{{ URL::route('quizz-new', array('number_of_questions' => 10)) }}" method="get">      
                <button class="btn btn-danger margin-20" type="submit"><h3>10 Questions Quiz</h3></button>
            </form>
        </div>

        <div>
            <form action="{{ URL::route('quizz-new', array('number_of_questions' => 20)) }}" method="get">      
                <button class="btn btn-success margin-20" type="submit"><h3>20 Questions Quiz</h3></button>
            </form>
        </div>

        <div>
            <form action="{{ URL::route('quizz-new', array('number_of_questions' => 35)) }}" method="get">      
                <button class="btn btn-warning margin-20" type="submit"><h3>35 Questions Quiz</h3></button>
            </form>
        </div>
        </div>
    </div>
</div>

@stop