@extends('layout.main')

@section('content')
    <form action="" method="post">
        <div>
            Email: <input type="text" name="email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>
            @if($errors->has('email'))
                {{ $errors->first('email') }}
            @endif
        </div>
        <input type="submit" value="recover">
        {{ Form::token() }}
    </form>
@stop