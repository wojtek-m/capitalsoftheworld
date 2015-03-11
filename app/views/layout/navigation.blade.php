<div class="navbar navbar-inverse" role="navigation">
    <div class="navbar-inner">
        <nav>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::route('home') }}">Home</a></li>
                    @if(Auth::check())
                        <li><a href="{{ URL::route('account-sign-out') }}">Sign out</a></li>
                        <li><a href="{{ URL::route('account-change-password') }}">Change password</a></li>
                        <li><a href="{{ URL::route('quizz-history') }}">My Quiz History</a></li>
                    @else
                        <li><a href="{{ URL::route('account-create') }}">Register</a></li>
                        <li><a href="{{ URL::route('account-sign-in') }}">Sign in</a></li>
                        <li><a href="{{ URL::route('account-forgot-password') }}">Forgot password</a></li>
                    @endif
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            Quiz
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ URL::route('quizz-new', array('number_of_questions' => 10)) }}">10 Questions Quiz</a></li>
                            <li><a href="{{ URL::route('quizz-new', array('number_of_questions' => 20)) }}">20 Questions Quiz</a></li>
                            <li><a href="{{ URL::route('quizz-new', array('number_of_questions' => 35)) }}">35 Questions Quiz</a></li>
                            <li><a href="{{ URL::route('quizz-new', array('number_of_questions' => 50)) }}">50 Questions Quiz</a></li>
                            <li><a href="{{ URL::route('quizz-new', array('number_of_questions' => 100)) }}">100 Questions Quiz</a></li>
                        </ul>   
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            Contries by Continent
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ URL::route('countries-list', 'Africa') }}">Africa</a></li>
                            <li><a href="{{ URL::route('countries-list', 'Antarctica') }}">Antarctica</a></li>
                            <li><a href="{{ URL::route('countries-list', 'Asia') }}">Asia</a></li>
                            <li><a href="{{ URL::route('countries-list', 'Europe') }}">Europe</a></li>
                            <li><a href="{{ URL::route('countries-list', 'NorthAmerica') }}">North America</a></li>
                            <li><a href="{{ URL::route('countries-list', 'Oceania') }}">Oceania</a></li>
                            <li><a href="{{ URL::route('countries-list', 'SouthAmerica') }}">South America</a></li>
                        </ul>   
                    </li>
                    <li><a href="{{ URL::route('about') }}">About</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>