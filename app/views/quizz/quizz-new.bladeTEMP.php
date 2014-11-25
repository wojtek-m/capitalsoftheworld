@extends('layout.main')

@section('content')
    <h1>Capitals of the World Quizz</h1>
    
    <!-- @foreach ($questions as $index => $question)
        <p>{{{ $index }}}. <strong>{{{ $question[0]['capital'] }}}</strong> is the capitol of {{{ $question[0]['countryName'] }}}</p>
    @endforeach 

    @if ($randomizer == 1) 
            $question1 = {{{ $question[0]['capital'] }}}
            $question2 = {{{ $all_capitals[$randomizer_250[2]]['capital'] }}}
            $question3 = {{{ $all_capitals[$randomizer_250[3]]['capital'] }}} 
    @elseif ($randomizer == 2) 
            $question1 = {{{ $all_capitals[$randomizer_250[1]]['capital'] }}}
            $question2 = {{{ $question[0]['capital'] }}}
            $question3 = {{{ $all_capitals[$randomizer_250[3]]['capital'] }}}
    @else
            $question1 = {{{ $all_capitals[$randomizer_250[1]]['capital'] }}}
            $question2 = {{{ $all_capitals[$randomizer_250[2]]['capital'] }}}
            $question3 = {{{ $question[0]['capital'] }}} 
    @endif
    -->

    <h3>Test printout</h3>
    <p>{{ Session::get($questions_idx[0])  }}</p>
    <p>{{ Session::get($questions[$questions_idx[0][0]])  }}</p>

    <h2>What is the capital of {{{ $questions[$questions_idx[0][0]] }}}?</h2>
     <form action="{{ URL::route('quizz-post') }}" method="post">
        
        <!-- QUESTION 1 
        <input type="radio" name="question" value="@if ($randomizer == 1) {{{ $question[0]['capital'] }}} 
                                                      @else {{{ $all_capitals[$randomizer_250[1]]['capital'] }}} 
                                                      @endif">
        <strong>
                @if ($randomizer == 1) 
                        {{{ $capitals[$q_index][0]['capital'] }}}
                @else 
                        {{{ $all_capitals[$randomizer_250[0]]['capital'] }}}
                @endif
        </strong><br>
        -->
        <!-- QUESTION 2 
        <input type="radio" name="question" value="@if ($randomizer == 2) {{{ $question[0]['capital'] }}}
                                                        @else {{{ $all_capitals[$randomizer_250[2]]['capital'] }}} 
                                                        @endif">
        <strong>
                @if ($randomizer == 2) 
                        {{{ $capitals[$q_index][0]['capital'] }}}
                @else 
                        {{{ $all_capitals[$randomizer_250[1]]['capital'] }}} 
                @endif
        </strong><br>
        -->
        <!-- QUESTION 3 
        <input type="radio" name="question" value="@if ($randomizer == 3) {{{ $question[0]['capital'] }}}
                                                        @else {{{ $all_capitals[$randomizer_250[3]]['capital'] }}} 
                                                        @endif">
        <strong>
                @if ($randomizer == 3) 
                        {{{ $capitals[$q_index][0]['capital'] }}}
                @else 
                        {{{ $all_capitals[$randomizer_250[2]]['capital'] }}} 
                @endif
        </strong><br>
        -->
        <input type="submit" value="Submit answer">
    </form>
@stop