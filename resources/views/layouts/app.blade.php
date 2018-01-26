<html>
    <head>
        <title>astrocurate - @yield('title')</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        <footer class="footer text-center">
          <div class="container">
            <p class="text-muted">Created by <a href="https://twitter.com/Shota_Nakai" target="_blank">Sho <i class="fa fa-twitter-square" aria-hidden="true"></i></a></p>
          </div>
        </footer>
    </body>
</html>