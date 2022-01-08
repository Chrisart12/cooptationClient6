<!DOCTYPE html>

<?php 
	
	$baseUrl = App::make('url')->to('/');
	
?>

<html lang="fr">
    <head>
		<meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
        <title>Administration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		{{ Html::style('resources/assets/css/style.css') }}
		{{ Html::style('resources/assets/css/bootstrap.min.css') }}
		{{ Html::style('resources/assets/css/summernote.css') }}
		{{ Html::style('resources/assets/css/font/fa4/css/font-awesome.min.css') }}
		
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
		<script src="//cdn.trackduck.com/toolbar/prod/td.js" async data-trackduck-id="5a421579f6e4132d51441720"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function () {
				$('#sidebarCollapse').on('click', function () {
					$('#sidebar').toggleClass('active');
					$(this).toggleClass('active');
				});
			});
		</script>
	</head>
	
	<body class="adminLayout">
		<div class="wrapper">
			<!-- Sidebar Holder -->
			<nav id="sidebar">
				<div class="sidebar-header">
					<img class="large" src="{{ $baseUrl }}/resources/assets/img/obeinglish-logo-rouge.svg"/> 
					<img class="small" src="{{ $baseUrl }}/resources/assets/img/obeinglish-ampoule-rouge.svg"/>
				</div>
				<div class="sidebar-person">
					<p>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
				</div>
				<ul class="list-unstyled components">
					<li class="link @if(in_array(Route::currentRouteName(), ['showAdminHome'])) {{ 'active' }} @endif">
						<a href="{{ route('showAdminHome') }}">
							<i class="glyphicon glyphicon-home"></i>
							<div>{{ ucfirst(Lang::get('label.home')) }}</div>
						</a>
					</li>
					<li class="link @if(in_array(Route::currentRouteName(), ['showAdminUserAccounts'])) {{ 'active' }} @endif">
						<a href="{{ route('showAdminUserAccounts') }}">
							<i class="glyphicon glyphicon-user"></i>
							<div>{{ ucfirst(Lang::get('label.userAccounts')) }}</div>
						</a>
					</li>
					<li class="link @if(in_array(Route::currentRouteName(), ['showAdminQuotations'])) {{ 'active' }} @endif">
						<a href="{{ route('showAdminQuotations') }}">
							<i class="glyphicon glyphicon-calendar"></i>
							<div>{{ ucfirst(Lang::get('label.quotations-management')) }}</div>
						</a>
					</li>
					<li class="link @if(in_array(Route::currentRouteName(), ['showAdminLessons'])) {{ 'active' }} @endif">
						<a href="{{ route('showAdminLessons') }}">
							<i class="glyphicon glyphicon-folder-open"></i>
							<div>{{ ucfirst(Lang::get('label.lessons-management')) }}</div>
						</a>
					</li>
					<li class="link @if(in_array(Route::currentRouteName(), ['showAdminTimesheet'])) {{ 'active' }} @endif">
						<a href="{{ route('showAdminTimesheet') }}">
							<i class="glyphicon glyphicon-file"></i>
							<div>{{ ucfirst(Lang::get('label.timesheet')) }}</div>
						</a>
					</li>
					<li class="link @if(in_array(Route::currentRouteName(), ['showAdminStatistics'])) {{ 'active' }} @endif">
						<a href="{{ route('showAdminStatistics') }}">
							<i class="glyphicon glyphicon-stats"></i>
							<div>{{ ucfirst(Lang::get('label.statistics')) }}</div>
						</a>
					</li>
					<li class="link @if(in_array(Route::currentRouteName(), ['showAdminLogs'])) {{ 'active' }} @endif">
						<a href="{{ route('showAdminLogs') }}">
							<i class="glyphicon glyphicon-floppy-save"></i>
							<div>{{ ucfirst(Lang::get('label.logs')) }}</div>
						</a>
					</li>
					<li class="link @if(in_array(Route::currentRouteName(), ['showAdminSettings'])) {{ 'active' }} @endif">
						<a href="{{ route('showAdminSettings') }}">
							<i class="glyphicon glyphicon-wrench"></i>
							<div>{{ ucfirst(Lang::get('label.settings')) }}</div>
						</a>
					</li>
				</ul>

				<ul class="list-unstyled CTAs">
					<li>
						<a href="{{ route('logout') }}" class="logout">
							<i class="glyphicon glyphicon-log-out"></i>
							<div>{{ ucfirst(Lang::get('label.logout')) }}</div>
						</a>
					</li>
				</ul>
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
								@if(in_array(Route::currentRouteName(), ['showAdminHome']))
									{{ ucfirst(Lang::get('label.home')) }} 
								@elseif(in_array(Route::currentRouteName(), ['showAdminUserAccounts']))
									{{ ucfirst(Lang::get('label.userAccounts')) }}
								@elseif(in_array(Route::currentRouteName(), ['showAdminQuotations']))
									{{ ucfirst(Lang::get('label.quotations-management')) }}
								@elseif(in_array(Route::currentRouteName(), ['showAdminLessons']))
									{{ ucfirst(Lang::get('label.lessons-management')) }}
								@elseif(in_array(Route::currentRouteName(), ['showAdminTimesheet']))
									{{ ucfirst(Lang::get('label.timesheet')) }}
								@elseif(in_array(Route::currentRouteName(), ['showAdminStatistics']))
									{{ ucfirst(Lang::get('label.statistics')) }}
								@elseif(in_array(Route::currentRouteName(), ['showAdminLogs']))
									{{ ucfirst(Lang::get('label.logs')) }}
								@elseif(in_array(Route::currentRouteName(), ['showAdminSettings']))
									{{ ucfirst(Lang::get('label.settings')) }}	
								@endif
							</h1>
							<div class="header notif">
								@include('partials.headerNotif')
							</div>
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