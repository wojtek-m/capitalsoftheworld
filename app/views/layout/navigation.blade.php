<nav>
    <ul>
        <li><a href="{{ URL::route('home') }}">Home</a></li>
        @if(Auth::check())
            <li><a href="{{ URL::route('account-sign-out') }}">Sign out</a></li>
            <li><a href="{{ URL::route('account-change-password') }}">Change password</a></li>
        @else
            <li><a href="{{ URL::route('account-create') }}">Register</a></li>
            <li><a href="{{ URL::route('account-sign-in') }}">Sign in</a></li>
            <li><a href="{{ URL::route('account-forgot-password') }}">Forgot password</a></li>
        @endif
        <li><a href="{{ URL::route('quizz') }}">Quizz</a></li>
        <li><a href="{{ URL::route('countries-list', 'Europe') }}">Countries in Europe</a></li>

        <li><a href="#">About us</a></li>
    </ul>
</nav>