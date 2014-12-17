@extends('layout.main')

@section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="well bs-component padding-50">
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>

                            <legend><h3>Recover Password</h3></legend>

                            <div class="control-group">
                                <label class="col-lg-2 control-label" for="inputEmail">Your email:</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" name="email" id="inputEmail" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>
                                    @if($errors->has('email'))
                                        {{ $errors->first('email') }}
                                    @endif
                                    <br>
                                </div>
                            </div>

                            <div class="col-lg-10 col-lg-offset-2">
                                <br><button class="btn btn-primary" type="submit">Recover</button>
                            </div>

                            {{ Form::token() }}

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
@stop