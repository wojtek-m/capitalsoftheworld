@extends('layout.main')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-6">
            <div class="well bs-component padding-75">
                <h3>Capitals of the World Quizz</h3>

                <div class="alert bg-danger">
                    <h2>Sorry...</h2>
                    <h4>We are sorry, but you can only take quizzes with up to {{ $max }} questions.
                    Please try one of the predefined quizzes below.</h4>
                </div>

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