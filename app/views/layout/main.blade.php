<!DOCTYPE html>
<html lang="en">
<img src="/images/7302477402_a95f6d12d4_o.jpg" id="bg" alt="">
<img class="world-image" src="/images/world-m.png">
    <head>
        <title>{{ $title or "" }} Capitals of the World Quizz</title>
        <meta name="description" content="{{ $description or "See how well do you know World Capitals by taking 'Capitals of the World Quiz'." }}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        <!-- jQuery served from a CDN -->
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

        <!-- Responsive slider - http://responsiveslides.com/ -->
        <link href="/css/slides/responsiveslides.css" rel="stylesheet" type="text/css"/>
        <script src="/js/slides/responsiveslides.min.js"></script>
    
        <!-- Bootstrap CSS & JavaScript served from a CDN -->
        <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.0/yeti/bootstrap.min.css" rel="stylesheet">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

        <!-- Custom CSS -->
        <link href="/css/styles.css" rel="stylesheet" type="text/css"/>
        <meta charset="utf-8">
        
        <!-- Google Analytics -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-328350-4', 'auto');
          ga('send', 'pageview');
        </script>
        
    
    </head>


    <body>
        <div id="main-wrap">          
            @include('layout.navigation')

            <div class="container-fluid main">
                    @if(Session::has('global'))
                    <div class="row-fluid">
                        <div class="global">
                            <div class="alert {{ Session::get('alert-type') }}">
                                    <h5>{{ Session::get('global') }}</h5>
                            </div>
                        </div>
                    </div>
                    @endif      
                    @yield('content')
            </div>     
        </div>
        <div class="container">
                @include('layout.footer')
        </div>
    </body>
</html>