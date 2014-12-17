@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="well bs-component padding-50">
                <form class="form-horizontal" action="{{ URL::route('feedback-post') }}" method="post">
                    <fieldset>
                    <legend><h3>Send feedback</h3></legend>
                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputEmail">Email:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="email" id="inputEmail" placeholder="Your email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>
                                <br>
                                @if($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputUsername">Name:</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="name" id="inputName" placeholder="Your Name">
                                <br>
                                @if($errors->has('name'))
                                    {{ $errors->first('name') }}
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="col-lg-2 control-label" for="inputPassword">Your Message:</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" maxlength="1000" name="message" id="inputPassword" placeholder="Write your feedback / message here (max 1000 characters)."></textarea>
                            </div>
                        </div>

                        <div class="col-lg-10 col-lg-offset-2">
                            <button type='submit' class="btn btn-primary margin-top-30">Send</button><br>
                        </div><br>

                        {{ Form::token() }}
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
@stop