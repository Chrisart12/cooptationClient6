<!DOCTYPE html>
<?php 
	
	$baseUrl = App::make('url')->to('/');
	$layout = "gallery";
	
?>
<html lang="fr">
    <head>
		<meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
        <title> Administration </title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
      	<meta name="theme-color" content="#000000"/>
		{{ Html::style('resources/assets/css/bootstrap.min.css') }}
		{{ Html::style('resources/assets/js/jquery-ui/jquery-ui.min.css') }}
		{{ Html::style('resources/assets/css/admin/style.css') }}
		{{ Html::style('resources/assets/css/admin/gallery/gallery.css') }}
		
		{{ Html::script('resources/assets/js/jquery-1.12.0.js') }}
		{{ Html::script('resources/assets/js/bootstrap.min.js') }}
		{{ Html::script('resources/assets/js/jquery-ui/jquery-ui.min.js') }}
      
        <!-- icon in the highest resolution we need it for -->
        <link rel="icon" sizes="192x192" href="{{ $baseUrl }}/resources/assets/icons/icon-192x192.png">
      
		<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet" type="text/css">
		{{-- Cooptation style --}}
		<link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
  </head>

	<body>
		<div class="wrapper">
			<nav class="navbar header navbar-expand-lg navbar-light bg-light">
				@if(in_array($layout, ['story']))
					<span class="back">
						<!-- <a class="link" href="{{ $baseUrl }}/admin"> -->
						<a class="link" href="{{ URL::previous() }}">
							<ion-icon name="arrow-round-back"></ion-icon>
						</a>
					</span>
				@elseif(in_array($layout, ['gallery']))
					<img id="logo" src="{{ Config::get('custom.project_url') }}resources/assets/img/logo_white.png" />
				@endif
				
				<span id="title" class="title"> {!! $title !!} </span>
				
				@if(in_array($layout, ['gallery']))
					<div id="logout">
						{{-- <a class="link" href="logout"> --}}
							<a class="link" href="{{route('admin.logout')}}">
							<ion-icon class="logout" name="close"></ion-icon>
						</a>
					</div>
				@endif

				<a class="col-md-offset-2" href="{{route('admin.candidats')}}"><button class="cooptation"> COOPTATION </button></a>
				<a class="col-md-offset-1" href="{{route('admin.offres.index')}}"><button class="cooptation"> OFFRES </button></a>
			</nav>
						{{-- @include('admin.partials.header', ['title'=>mb_strtoupper(Lang::get('admin.top')), 'layout'=>$layout]) --}}
			<!-- Page Content Holder -->
			<div class="container">
				@yield('content')
			</div>
		</div>
		<!-- ionicons -->
		<script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
		<script type="text/javascript" src="{{ asset('public/js/cooptation.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/js/moment.min.js') }}"></script>
	</body>
</html>