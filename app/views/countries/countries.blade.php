@extends('layout.main')

@section('content')
    <h1>A list of countries in {{ $countries->first()->continentName }}</h1>

    @foreach ($countries as $country)
            <h3>{{ $country->countryName }}</h3>
            <p>The capital of {{ $country->countryName }} is <strong>{{ $country->capital }}</strong>.</p>
            <p>{{ $country->countryName }} has {{ number_format($country->population) }} inhabitants. </p>
    @endforeach
@stop