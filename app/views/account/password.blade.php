@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="form well bs-component padding-50">
                
                <form class="form-horizontal" action="{{ URL::route('account-change-password-post') }}" method="post"> 
                    <fieldset>
                    <legend><h3>Change Password</h3></legend> 

                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="oldPassword">Old Password:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" name="old_password" placeholder="Old password" id="oldPassword">
                                @if($errors->has('old_password'))
                                    {{ $errors->first('old_password') }}
                                @endif
                            </div>
                        </div>     

                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputPassword">New Password:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" placeholder="New password" name="new_password" id="inputPassword">
                                @if($errors->has('new_password'))
                                    {{ $errors->first('new_password') }}
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputPasswordAgain">Confirm New Password:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" placeholder="Repeat new password" name="new_password_again" id="inputPasswordAgain">
                                @if($errors->has('new_password_again'))
                                    {{ $errors->first('new_password_again') }}
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-10 col-lg-offset-2">
                            <br><button class="btn btn-primary" type="submit">Change Password</button>
                        </div>
                        {{ Form::token() }}
                    
                    </fieldset>
                </form>
                

            </div>
        </div>
    </div> 
@stop