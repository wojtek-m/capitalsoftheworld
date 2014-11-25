@extends('layout.main')

@section('content')
    <h1>Capitals of the World Quizz</h1>

    <h2>Finish page</h2>
    
    <h2>That is {{ $feedback }}. The capital of {{ $questions_idx[$q_index - 1][0] }} is {{ $questions_idx[$q_index - 1][1] }}</h2>
    
    <h2>You have answered {{ $correct_answers }} out of {{ $answered_questions }} questions correctly.</h2>
    <h1>Your score is: {{ sprintf("%.0f%%", ($correct_answers / $answered_questions) * 100) }}</h1>

    <h4>Do you want to try another quizz?</h4>
    <form action="{{ URL::route('quizz-new') }}" method="get">      
        <input type="submit" value="New Quizz">
    </form>
@stop