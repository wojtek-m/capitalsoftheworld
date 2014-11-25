@extends('layout.main')

@section('content')
    <h1>Capitals of the World Quizz</h1>

    <h3>Test printout</h3>
    <p>{{ $questions_idx[0][0]  }}</p>

    <h2>What is the capital of {{ $questions_idx[$q_index][0] }}?</h2>
     <form action="{{ URL::route('quizz-post') }}" method="post">
        
        <!-- QUESTION 1 -->
        <input type="radio" name="question" value="@if ($randomizer == 1) {{{ $questions_idx[$q_index][1] }}} 
                                                      @else {{ $all_capitals[$randomizer_250[1]] }} 
                                                      @endif">
        <strong>
                @if ($randomizer == 1) 
                        {{ $questions_idx[$q_index][1]  }}
                @else 
                        {{ $all_capitals[$randomizer_250[1]]  }}
                @endif
        </strong><br>
        
        <!-- QUESTION 2 -->
        <input type="radio" name="question" value="@if ($randomizer == 2) {{{ $questions_idx[$q_index][1] }}}
                                                        @else {{ $all_capitals[$randomizer_250[2]]  }} 
                                                        @endif">
        <strong>
                @if ($randomizer == 2) 
                        {{ $questions_idx[$q_index][1]  }}
                @else 
                        {{ $all_capitals[$randomizer_250[2]]  }} 
                @endif
        </strong><br>
        
        <!-- QUESTION 3 -->
        <input type="radio" name="question" value="@if ($randomizer == 3) {{{ $questions_idx[$q_index][1] }}}
                                                        @else {{ $all_capitals[$randomizer_250[3]]  }} 
                                                        @endif">
        <strong>
                @if ($randomizer == 3) 
                        {{ $questions_idx[$q_index][1]  }}
                @else 
                        {{ $all_capitals[$randomizer_250[3]]  }}
                @endif
        </strong><br>

        <!-- QUESTION 4 -->
        <input type="radio" name="question" value="@if ($randomizer == 4) {{{ $questions_idx[$q_index][1] }}}
                                                        @else {{ $all_capitals[$randomizer_250[4]]  }} 
                                                        @endif">
        <strong>
                @if ($randomizer == 4) 
                        {{ $questions_idx[$q_index][1]  }}
                @else 
                        {{ $all_capitals[$randomizer_250[4]]  }}
                @endif
        </strong><br>

        <!-- QUESTION 5 -->
        <input type="radio" name="question" value="@if ($randomizer == 5) {{{ $questions_idx[$q_index][1] }}}
                                                        @else {{ $all_capitals[$randomizer_250[5]]  }} 
                                                        @endif">
        <strong>
                @if ($randomizer == 5) 
                        {{ $questions_idx[$q_index][1]  }}
                @else 
                        {{ $all_capitals[$randomizer_250[5]]  }}
                @endif
        </strong><br>
        
        <input type="submit" value="Submit answer">
    </form>
@stop