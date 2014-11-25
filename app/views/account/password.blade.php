@extends('layout.main')

@section('content')
    <form action="{{ URL::route('account-change-password-post') }}" method="post">
        
        <div class="field">
            Old password: <input type="password" name="old_password">
            @if($errors->has('old_password'))
                {{ $errors->first('old_password') }}
            @endif
        </div>

        <div class="field">
            New password: <input type="password" name="new_password">
            @if($errors->has('new_password'))
                {{ $errors->first('new_password') }}
            @endif
        </div>

        <div class="field">
            Confirm new password: <input type="password" name="new_password_again">
            @if($errors->has('new_password_again'))
                {{ $errors->first('new_password_again') }}
            @endif
        </div>

        <input type="submit" value="Change password">
        {{ Form::token() }}

    </form>
@stop