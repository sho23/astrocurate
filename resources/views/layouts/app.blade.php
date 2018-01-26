<html>
    <head>
        <title>astrocurate - @yield('title')</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="{{ asset('/images/logo.ico') }}" sizes="128x128">
        <meta property="og:title" content="アストロキュレート 今日の運勢を横断検索！">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://blond.boo.jp/astrocurate/">
        <meta property="og:image" content="{{ asset('/images/og_image.png') }}">
        <meta property="og:site_name" content="アストロキュレート">
        <meta property="og:description" content="今日の運勢のキュレーション！あなたの今日の運勢は？">
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