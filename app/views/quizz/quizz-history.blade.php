@extends('layout.main')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="well bs-component padding-75">
                <h3>A history of your quizzes</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p>You have answered <strong>{{ $total_answered }}</strong> questions in total and <strong>{{ $total_correct }}</strong> of them correctly.</p>
                    </div>
                    <div class="col-md-6 margin-bottom-25">
                        <h4>Your average score is: <strong>{{ sprintf("%.0f%%", $average_score) }}.</strong></h4>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Quiz Unique ID</th>
                            <th>Number of Questions</th>
                            <th>Correct Answers</th>
                            <th>Score (%)</th>
                            <th>Date and Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($quizz_history as $idx=>$quizz)
                        <tr class="@if ($quizz->score < 50) danger @elseif ($quizz->score < 75) warning @else success @endif">
                            <td>{{ $idx + 1 }}</td>
                            <td>{{ $quizz->ID }}</td>
                            <td>{{ $quizz->quiz_type }}</td>
                            <td>{{ $quizz->correct_answers }}</td>
                            <td>{{ $quizz->score }}</td>
                            <td>{{ $quizz->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop