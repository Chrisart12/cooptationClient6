<!DOCTYPE html>
<?php 
	
	$baseUrl = App::make('url')->to('/');
	$layout = "login";
	
?>
<html lang="fr">
    <head>
		<meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
        <title> MaStory </title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
      	<meta name="theme-color" content="#000000"/>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		{{ Html::style('resources/assets/css/bootstrap.min.css') }}
		{{ Html::style('resources/assets/js/jquery-ui/jquery-ui.min.css') }}
		{{ Html::style('resources/assets/css/admin/style.css') }}
		{{ Html::style('resources/assets/css/admin/login/login.css') }}
		
		{{ Html::script('resources/assets/js/jquery-1.12.0.js') }}
		{{ Html::script('resources/assets/js/bootstrap.min.js') }}
		{{ Html::script('resources/assets/js/jquery-ui/jquery-ui.min.js') }}
      
		<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet" type="text/css">
  </head>

	<body>
		<div class="wrapper">
			<!-- Page Content Holder -->
			<div class="container">
				@yield('content')
			</div>
		</div>
		<!-- ionicons -->
		<script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
	</body>
</html>