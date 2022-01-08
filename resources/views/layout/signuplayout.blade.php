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
		{{ Html::style('resources/assets/css/style.css') }}
		{{ Html::style('resources/assets/css/signup/signup.css') }}
		
		{{ Html::script('resources/assets/js/jquery-1.12.0.js') }}
		{{ Html::script('resources/assets/js/bootstrap.min.js') }}
		{{ Html::script('resources/assets/js/jquery-ui/jquery-ui.min.js') }}
      
		<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet" type="text/css">
		<link rel="manifest" href="{{ $baseUrl }}/manifest.json">	
        <!-- include PWACompat _after_ your manifest -->
        <script async src="https://cdn.jsdelivr.net/npm/pwacompat@2.0.6/pwacompat.min.js"
            integrity="sha384-GOaSLecPIMCJksN83HLuYf9FToOiQ2Df0+0ntv7ey8zjUHESXhthwvq9hXAZTifA"
            crossorigin="anonymous"></script>
      
        <!-- icon in the highest resolution we need it for -->
        <link rel="icon" sizes="192x192" href="{{ $baseUrl }}/resources/assets/icons/icon-192x192.png">
        <!-- reuse same icon for Safari -->
        <link rel="apple-touch-icon" href="{{ $baseUrl }}/resources/assets/icons/apple-icon.png">
  </head>

	<body>
		<div class="wrapper">
			<!-- Page Content Holder -->
			<div class="container">
				@yield('content')
				<!-- <div class="col-xs-12 col-sm-12 col-md-12">
					<button onclick="install()">
						Install
					</button>
				</div> -->
			</div>
		</div>
        <script>
		// CODELAB: Register service worker.
		if ('serviceWorker' in navigator) {
		  window.addEventListener('load', () => {
			navigator.serviceWorker.register('service-worker.js')
			.then((reg) => {
			  console.log('Service worker registered.', reg);
			});
		  });
		}
        </script>
        <script>
		// PWABUILDER: PWA install popup
		/*let deferredPrompt = null;

		window.addEventListener('beforeinstallprompt', (e) => { alert();
			// Prevent Chrome 67 and earlier from automatically showing the prompt
			e.preventDefault();
			// Stash the event so it can be triggered later.
			deferredPrompt = e;
			// install popup
			install();
		});

		async function install() {
			if (deferredPrompt) {
				deferredPrompt.prompt();
				console.log(deferredPrompt)
				deferredPrompt.userChoice.then(function(choiceResult){
					if (choiceResult.outcome === 'accepted') {
						console.log('Your PWA has been installed');
					} else {
						console.log('User chose to not install your PWA');
					}
					deferredPrompt = null;
				});
			}
		}*/
        </script>
	</body>
</html>