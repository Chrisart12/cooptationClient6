<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <!-- Styles -->
   
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('icons/logo6.png') }}">


    <title>MaStory | {{ $title or '' }}</title>

    {!! Html::style("css/styles.css") !!}
    <!--[if lt IE 9]>
        {!! Html::script("https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js") !!}
        {!! Html::script("https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js") !!}
    <![endif]-->
</head>
    <body id="body">
        <div id="app">
           
            <div id="page404" >
                  <p class="center-block">404</p>
                  <p>La page que vous recherchez est introuvable</p>
            </div>
        </div>
      
    </body>
</html>

