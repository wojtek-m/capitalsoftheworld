@extends('layout.main')

@section('content')
    <h1>{{ 'Quizz geograficzny - stolice świata' }}</h1><br>

    @if (Auth::check())
        <h4>Hello, {{ Auth::user()->username }}</h4> <br>You are signed in.
    @else
        {{ 'Welcome to our site! You are not signed in.' }}
    @endif
@stop