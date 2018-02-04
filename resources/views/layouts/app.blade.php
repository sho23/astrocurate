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
        <meta property="og:url" content="http://astrocurate.info/">
        <meta property="og:image" content="{{ asset('/images/ogpfb-min.png') }}">
        <meta property="og:site_name" content="アストロキュレート">
        <meta property="og:description" content="今日の運勢のキュレーション！あなたの今日の運勢は？">

        <meta name="twitter:image" content="{{ asset('/images/ogptw.png') }}" />
        <meta name="twitter:card" content="summary_large_image">

        <link rel="shortcut icon" href="{{ asset('/images/homeicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('/images/homeicon.png') }}">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113135718-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-113135718-1');
        </script>

        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-4535676757936671",
            enable_page_level_ads: true
          });
        </script>
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