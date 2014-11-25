<!DOCTYPE html>
<html>
    <head>
        <title>Quizz Geograficzny TEST TEST</title>
    </head>
    <body>
        @if(Session::has('global'))
            <p>{{ Session::get('global') }}</p>
        @endif

        @include('layout.navigation')
        @yield('content')
    </body>
</html>