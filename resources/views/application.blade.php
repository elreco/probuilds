<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible"
            content="IE=edge">
      <meta name="viewport"
            content="width=device-width,initial-scale=1.0">
      <meta name="csrf-token"
            content="{{ csrf_token() }}">
      <!-- <link rel="icon" href="<%= BASE_URL %>favicon.ico"> -->

      <title></title>
      <!-- Styles -->
      <link rel="stylesheet"
            href="{{ secure_asset(mix('css/main.css')) }}">
      <link rel="stylesheet"
            href="{{ secure_asset(mix('css/iconfont.css')) }}">
      <link rel="stylesheet"
            href="{{ secure_asset(mix('css/material-icons/material-icons.css')) }}">
      <link rel="stylesheet"
            href="{{ secure_asset(mix('css/vuesax.css')) }}">
      <link rel="stylesheet"
            href="{{ secure_asset(mix('css/prism-tomorrow.css')) }}">
      <link rel="stylesheet"
            href="{{ secure_asset(mix('css/app.css')) }}">
      <!-- Favicon -->
      <link rel="apple-touch-icon"
            sizes="180x180"
            href="{{ secure_asset('images/favicon/apple-touch-icon.png') }}">
      <link rel="icon"
            type="image/png"
            sizes="32x32"
            href="{{ secure_asset('images/favicon/favicon-32x32.png') }}">
      <link rel="icon"
            type="image/png"
            sizes="16x16"
            href="{{ secure_asset('images/favicon/favicon-16x16.png') }}">
      <link rel="manifest"
            href="{{ secure_asset('images/favicon/site.webmanifest') }}">
      <link rel="mask-icon"
            href="{{ secure_asset('images/favicon/safari-pinned-tab.svg') }}"
            color="#5bbad5">
      <meta name="msapplication-TileColor"
            content="#da532c">
      <meta name="theme-color"
            content="#ffffff">
      <meta name="csrf-token"
            content="{{ csrf_token() }}">
</head>

<body>
      <noscript>
            <strong>We're sorry but Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template doesn't work properly without
                  JavaScript enabled. Please enable it to continue.</strong>
      </noscript>
      <div id="app">
      </div>

      <!-- <script src="js/app.js"></script> -->
      <script src="{{ asset(mix('js/app.js')) }}"></script>

</body>

</html>