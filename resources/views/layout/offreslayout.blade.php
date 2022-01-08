<!DOCTYPE html>
<?php 
	
	$baseUrl = App::make('url')->to('/');
	$layout = "gallery";
	
?>
<html lang="fr">
    <head>
		<meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
        <title> MaStory </title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
      	<meta name="theme-color" content="#000000"/>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
	
		{{ Html::style('resources/assets/css/bootstrap.min.css') }}
		{{ Html::style('resources/assets/js/jquery-ui/jquery-ui.min.css') }}
		{{ Html::style('resources/assets/css/style.css') }}
		{{ Html::style('resources/assets/css/gallery/gallery.css') }}
		
		{{ Html::script('resources/assets/js/jquery-1.12.0.js') }}
		{{ Html::script('resources/assets/js/bootstrap.min.js') }}
		{{ Html::script('resources/assets/js/jquery-ui/jquery-ui.min.js') }}
		 

		<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet" type="text/css">
		<link rel="manifest" href="{{ $baseUrl }}/manifest.json">	
        <!-- include PWACompat _after_ your manifest -->
       
        <!-- icon in the highest resolution we need it for -->
        <link rel="icon" sizes="192x192" href="{{ $baseUrl }}/resources/assets/icons/icon-192x192.png">
        <!-- reuse same icon for Safari -->
        <link rel="apple-touch-icon" href="{{ $baseUrl }}/resources/assets/icons/apple-icon.png">
        <!-- Css cooptationClient -->
        <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
  </head>

	<body>
		<div class="wrapper">
            @include('partials.headeroffres', ['title'=>strtoupper(Lang::get('label.mastory-title')), 'layout'=>$layout])
            
			<!-- Page Content Holder -->
			<div class="container">
				@yield('content')
			</div>
			@include('partials.footer')
		</div>
        <script>
			if(window.navigator && navigator.serviceWorker) {
				navigator.serviceWorker.getRegistrations()
				.then(function(registrations) {
					for(let registration of registrations) {
						registration.unregister();
					}
				});
			}

		// CODELAB: Register service worker.
		if ('serviceWorker' in navigator) {
		  window.addEventListener('load', () => {
			// navigator.serviceWorker.register('/service-worker.js')
			navigator.serviceWorker.register('service-worker.js')
			.then((reg) => {
			  console.log('Service worker registered.', reg);
			});
		  });
		}
        </script>
		<!-- ionicons -->
	
	
				<script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
        <script src="{{ asset('public/js/cooptation.js') }}"></script>
	</body>
</html>