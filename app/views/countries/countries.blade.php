@extends('layout.main')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="well bs-component padding-75">
                <h1>A list of countries in {{ $countries->first()->continentName }}</h1>

                @foreach ($countries as $country)
                        <h3><a href="{{ URL::route('country', $country->countryName) }}">{{ $country->countryName }}</a></h3>
                        <p>The capital of {{ $country->countryName }} is <strong>{{ $country->capital }}</strong>.</p>
                        <p>{{ $country->countryName }} has {{ number_format($country->population) }} inhabitants. </p>
                @endforeach
            </div>
        </div>
    </div>

@stop