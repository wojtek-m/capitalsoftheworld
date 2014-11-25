@extends('layout.main')

@section('content')
    <h1>Capitals of the World Quizz</h1>

    <h2>Feedback page</h2>
    
    <h2>That is {{ $feedback }}. The capital of {{ $questions_idx[$q_index - 1][0] }} is {{ $questions_idx[$q_index - 1][1] }}</h2>

     <form action="{{ URL::route('quizz') }}" method="get">      
        <input type="submit" value="Next question">
    </form>
@stop