<!DOCTYPE html>
<?php
	// on définit la langue utilisée
	// App::setLocale($_SESSION['lang']['list'][$_SESSION['lang']['id']]);
	
	$baseUrl = App::make('url')->to('/');
?>
<html>
    <head>
		<meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
        <title>o'bEnglish</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		{{ Html::style('resources/assets/css/style.css') }}
		{{ Html::style('resources/assets/css/bootstrap.min.css') }}
		{{ Html::style('resources/assets/css/summernote.css') }}
		{{ Html::style('resources/assets/css/font/fa4/css/font-awesome.min.css') }}
		{{ Html::style('resources/assets/plugins/awesome-rating-master/dist/awesomeRating.min.css') }}
		
		{{ Html::style('resources/assets/js/jquery-ui/jquery-ui.min.css') }}
		
		{{ Html::script('resources/assets/js/jquery-1.12.0.js') }}
		{{ Html::script('resources/assets/js/bootstrap.min.js') }}

		{{ Html::script('resources/assets/js/jquery-ui/jquery-ui.min.js') }}
		
		{{ Html::script('resources/assets/js/summernote.min.js') }}
		{{ Html::script('resources/assets/js/lang/summernote-fr-FR.js') }}
		{{ Html::script('resources/assets/js/lang/fr.js') }}
        {{ Html::script('resources/assets/js/html2canvas.js') }}
        {{ Html::script('resources/assets/js/jspdf.js') }}
        {{ Html::script('resources/assets/js/knockout.js') }}
		{{ Html::script('resources/assets/js/moment.js') }}
		
        {{ Html::script('resources/assets/js/main.js') }}
		
		<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet" type="text/css">
		<!-- <script async src="//d1ks1friyst4m3.cloudfront.net/toolbar/prod/td.js" data-trackduck-id=""></script> -->
		<script src="//cdn.trackduck.com/toolbar/prod/td.js" async data-trackduck-id="5a421579f6e4132d51441720"></script>
		<script>
			$(document).ready(function () {
				$('#sidebarCollapse').on('click', function () {
					$('#sidebar').toggleClass('active');
					$(this).toggleClass('active');
				});
			});
		</script>
    </head>
	
    <body class="studentLayout">
		<div class="wrapper">
			<!-- Sidebar Holder -->
			<nav id="sidebar">
				<div class="sidebar-header">
					<img class="large" src="{{ $baseUrl }}/resources/assets/img/obeinglish-logo-rouge.svg"/> 
					<img class="small" src="{{ $baseUrl }}/resources/assets/img/obeinglish-ampoule-rouge.svg"/>
				</div>
			</nav>
			<!-- Page Content Holder -->
			<div id="content">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" id="sidebarCollapse" class="navbar-btn">
								<span></span>
								<span></span>
								<span></span>
							</button>
							<h1>
								Erreur
							</h1>
						</div>
					</div>
				</nav>

				<div class="col-xs-12 col-sm-12 col-md-12">
					@yield('content')
				</div>
			</div>
		</div>
	</body>
</html>