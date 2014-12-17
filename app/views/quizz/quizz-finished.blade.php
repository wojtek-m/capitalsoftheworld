@extends('layout.main')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-6">
            <div class="well bs-component padding-75">
                <h5>Capitals of the World Quizz</h5>
             
                <h4>That was your last question and your answer was {{ $feedback }}. The capital of {{ $questions_idx[$q_index - 1][0] }} is {{ $questions_idx[$q_index - 1][1] }}</h4>
                
                <div class="alert alert-info">
                    <h4>You have answered {{ $correct_answers }} out of {{ $answered_questions }} questions correctly.</h4>
                </div>
                
                @if ((($correct_answers / $answered_questions) * 100) > 70)
                    <div class="alert alert-success">
                        <h2>Your score is: {{ sprintf("%.0f%%", ($correct_answers / $answered_questions) * 100) }}</h2>
                    </div>
                @elseif ((($correct_answers / $answered_questions) * 100) > 50)
                    <div class="alert alert-warning">
                        <h2>Your score is: {{ sprintf("%.0f%%", ($correct_answers / $answered_questions) * 100) }}</h2>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <h2>Your score is: {{ sprintf("%.0f%%", ($correct_answers / $answered_questions) * 100) }}</h2>
                    </div>
                @endif

                <h5>Do you want to try another quizz?</h5>
                
                <div>
                    <form action="{{ URL::route('quizz-new', array('number_of_questions' => 10)) }}" method="get">      
                        <button class="btn btn-warning" type="submit">10 Questions Quizz</button>
                    </form>
                </div>

                <div>
                    <form action="{{ URL::route('quizz-new', array('number_of_questions' => 20)) }}" method="get">      
                        <button class="btn btn-warning" type="submit">20 Questions Quizz</button>
                    </form>
                </div>

                <div>
                    <form action="{{ URL::route('quizz-new', array('number_of_questions' => 35)) }}" method="get">      
                        <button class="btn btn-warning" type="submit">35 Questions Quizz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop