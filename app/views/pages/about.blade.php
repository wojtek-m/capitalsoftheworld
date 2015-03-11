@extends('layout.main')

@section('content')

<div class="row">
        <div class="col-lg-6">
            <div class="well bs-component padding-50">
                <h3>About</h3>
                <div>
                    <p>If you are looking to test the knowledge of world countries capitals, this is a website for you. You can select one of the predefined quizzes from the menu or take a quiz of any size up to 200 questions
                    simply by changing the questions number in the url, for example, for 75 questions you would have to use <a href="{{ URL::route('quizz-new', array('number_of_questions' => 75)) }}">{{ URL::route('quizz-new', array('number_of_questions' => 75)) }}</a></p>
                    If you decide to <a href="{{ URL::route('account-create') }}">register</a> for an account, you will be able to track the results of your past quizzes and your average scores. 
                </div>
                <div>
                    <h3>Credits</h3>
                    <p>This website was built as a final project of the <a href="https://cs50.harvard.edu/">CS50 computer science course</a> by HarvardX offered on 
                    <a href="https://www.edx.org/course/introduction-computer-science-harvardx-cs50x">edX</a>. It was built in <a href="http://php.net/">PHP</a> using <a href="http://laravel.com/">Laravel</a> 
                    framework and Twitter <a href="http://getbootstrap.com/">Bootstrap</a> with a help of some awesome tools 
                    including <a href="https://www.vagrantup.com/">Vagrant VMware</a>, <a href="http://www.sublimetext.com/">Sublime Text</a> 
                    and <a href="http://bliker.github.io/cmder/">Cmder</a>. The website uses data from <a href="http://dbpedia.org/About">DBpedia</a> and <a href="https://www.flickr.com/">Flickr</a> API to display images.</p>
                    <p>Background Image by <a href="https://www.flickr.com/photos/angeloangelo/7302477402/">Angelo DeSantis</a></p>
                    <p>Web developement by Wojtek Murawski</p>
                </div>
                <div>
                    <h3>Feedback</h3>
                    <p>Feel free to send me any feedback using this form: <a href="{{ URL::route('feedback') }}">Send Feedback</a></p>
                </div> 
            </div>
            
        </div>
</div>

@stop