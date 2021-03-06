@extends('layout.main')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="well bs-component col-xs-12 padding-75">
                <h5>Capitals of the World Quiz</h5>

                <h4>Question number {{ $q_index + 1 }} / {{ $number_of_questions }}</h4><br>
                @if($errors->has('question'))
                    <div class="alert alert-danger"><h5>{{ 'You have to select an answer to continue.' }}</h5></div>
                @endif
                 <form action="{{ URL::route('quizz-post') }}" method="post">
                    <fieldset>
                        <legend><h3>What is the capital of {{ $questions_idx[$q_index][0] }}?</h3></legend>
                        
                        <!-- QUESTION 1 -->
                        <label class="radio">
                            <input type="radio" name="question" value="@if ($randomizer == 1) {{{ $questions_idx[$q_index][1] }}} 
                                                                        @elseif ($all_capitals[$randomizer_250[1]] == $questions_idx[$q_index][1])
                                                                            {{ $all_capitals[$randomizer_250[10]]}} 
                                                                        @else
                                                                            {{ $all_capitals[$randomizer_250[1]] }} 
                                                                        @endif">
                            <h4>
                                    @if ($randomizer == 1) 
                                        {{{ $questions_idx[$q_index][1] }}} 
                                    @elseif ($all_capitals[$randomizer_250[1]] == $questions_idx[$q_index][1])
                                        {{ $all_capitals[$randomizer_250[10]]}}
                                    @else
                                        {{ $all_capitals[$randomizer_250[1]] }} 
                                    @endif
                            </h4>
                        </label>
                        
                        <!-- QUESTION 2 -->
                        <label class="radio">
                            <input type="radio" name="question" value="@if ($randomizer == 2) {{{ $questions_idx[$q_index][1] }}}
                                                                        @elseif ($all_capitals[$randomizer_250[2]] == $questions_idx[$q_index][1])
                                                                            {{ $all_capitals[$randomizer_250[10]]}} 
                                                                        @else
                                                                            {{ $all_capitals[$randomizer_250[2]]}} 
                                                                        @endif">
                            <h4>
                                    @if ($randomizer == 2) 
                                        {{{ $questions_idx[$q_index][1] }}}
                                    @elseif ($all_capitals[$randomizer_250[2]] == $questions_idx[$q_index][1])
                                        {{ $all_capitals[$randomizer_250[10]]}} 
                                    @else
                                        {{ $all_capitals[$randomizer_250[2]]}} 
                                    @endif
                            </h4>
                        </label>
                        
                        <!-- QUESTION 3 -->
                        <label class="radio">
                            <input type="radio" name="question" value="@if ($randomizer == 3) {{{ $questions_idx[$q_index][1] }}}
                                                                        @elseif ($all_capitals[$randomizer_250[3]] == $questions_idx[$q_index][1])
                                                                            {{ $all_capitals[$randomizer_250[10]]}} 
                                                                        @else
                                                                            {{ $all_capitals[$randomizer_250[3]]}} 
                                                                        @endif">
                            <h4>
                                    @if ($randomizer == 3) 
                                        {{{ $questions_idx[$q_index][1] }}}
                                    @elseif ($all_capitals[$randomizer_250[3]] == $questions_idx[$q_index][1])
                                        {{ $all_capitals[$randomizer_250[10]]}}
                                    @else
                                        {{ $all_capitals[$randomizer_250[3]]}}
                                    @endif
                            </h4>
                        </label>

                        <!-- QUESTION 4 -->
                        <label class="radio">
                            <input type="radio" name="question" value="@if ($randomizer == 4) {{{ $questions_idx[$q_index][1] }}}
                                                                        @elseif ($all_capitals[$randomizer_250[4]] == $questions_idx[$q_index][1])
                                                                            {{ $all_capitals[$randomizer_250[10]]}} 
                                                                        @else
                                                                            {{ $all_capitals[$randomizer_250[4]]}} 
                                                                        @endif">
                            <h4>
                                    @if ($randomizer == 4) 
                                        {{{ $questions_idx[$q_index][1] }}}
                                    @elseif ($all_capitals[$randomizer_250[4]] == $questions_idx[$q_index][1])
                                        {{ $all_capitals[$randomizer_250[10]]}}
                                    @else
                                        {{ $all_capitals[$randomizer_250[4]]}}
                                    @endif
                            </h4>
                        </label>

                        <!-- QUESTION 5 -->
                        <label class="radio">
                            <input type="radio" name="question" value="@if ($randomizer == 5) {{{ $questions_idx[$q_index][1] }}}
                                                                        @elseif ($all_capitals[$randomizer_250[5]] == $questions_idx[$q_index][1])
                                                                            {{ $all_capitals[$randomizer_250[10]]}} 
                                                                        @else
                                                                            {{ $all_capitals[$randomizer_250[5]]}} 
                                                                        @endif">
                            <h4>
                                    @if ($randomizer == 5) 
                                        {{{ $questions_idx[$q_index][1] }}}
                                    @elseif ($all_capitals[$randomizer_250[5]] == $questions_idx[$q_index][1])
                                        {{ $all_capitals[$randomizer_250[10]]}}
                                    @else
                                        {{ $all_capitals[$randomizer_250[5]]}}
                                    @endif
                            </h4>
                        </label>
                        <div class="padding-75">
                            <button class="btn btn-info" type="submit">Submit answer</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop