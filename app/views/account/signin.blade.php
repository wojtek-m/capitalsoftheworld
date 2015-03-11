@extends('layout.main')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-6">
            <div class="form well bs-component padding-50">
                
                <form class="form-horizontal" action="{{ URL::route('account-sign-in-post') }}" method="post"> 
                    <fieldset>
                    <legend><h3>Sign in</h3></legend>                 
                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputEmail">Email:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Your e-mail" name="email" id="inputEmail" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>
                                @if($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputPassword">Password:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" placeholder="Password" name="password" id="inputPassword">
                                @if($errors->has('password'))
                                    {{ $errors->first('password') }}
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="col-lg-10">
                                <input type="checkbox" name="remember" id="inputRemember">
                                <label for="inputRememeber"><br>Remember me</label>
                        </div>

                        <div class="col-lg-10 col-lg-offset-2">
                            <br><button class="btn btn-primary" type="submit">Sign in</button>
                        </div>
                        {{ Form::token() }}
                    
                    </fieldset>
                </form>
                

            </div>
        </div>
    </div>
@stop