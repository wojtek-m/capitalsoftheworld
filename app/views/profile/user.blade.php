@extends('layout.main')

@section('content')

    <h2>{{ e($user->username) }} profile.</h2>
    <h3>{{ e($user->email) }}</h3>

@stop