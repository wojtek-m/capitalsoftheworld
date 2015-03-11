@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="form well bs-component padding-50">
                <form class="form-horizontal" action="{{ URL::route('account-create-post') }}" method="post">
                    <fieldset>
                    <legend><h3>Register</h3></legend>
                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputEmail">Email:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="email" id="inputEmail" placeholder="Your e-mail" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>
                                <br>
                                @if($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputUsername">Username:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="username" id="inputUsername" placeholder="Your username" {{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }}>
                                <br>
                                @if($errors->has('username'))
                                    {{ $errors->first('username') }}
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputPassword">Password:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" name="password" id="inputPassword" placeholder="Password">
                                <br>
                                @if($errors->has('password'))
                                    {{ $errors->first('password') }}
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputPassword_again">Password again:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" name="password_again" id="inputPassword" placeholder="Repeat password">
                                <br>
                                @if($errors->has('password_again'))
                                    {{ $errors->first('password_again') }}
                                @endif
                                <br>
                            </div>
                        </div>

                        <div class="col-lg-10 col-lg-offset-2">
                            <button type='submit' class="btn btn-primary">Create an account</button>
                        </div>

                        {{ Form::token() }}
                    </fieldset>



                </form>
            </div>
        </div>
    </div>
@stop