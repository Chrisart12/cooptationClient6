@extends('layout.mystorylayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row mystory">
	<div class="col-xs-12 content">
      	<div class="row galerymode outofviewport">
        	Gallery (sélection galerie)
			<div class="col-xs-12"> 
				{{ Form::open(array('name' => 'galleryPicture', 'url' => 'setMyStoryPicture', 'enctype' => 'multipart/form-data')) }}
					{{ csrf_field() }}
					<input id="galleryUser" name="image" type="file" accept="image/*">
				{{ Form::close() }}
			</div>
      	</div>
		
      	<div class="row capturemode outofviewport">
        	Capture User (capture caméra)
			<div class="col-xs-12"> 
				{{ Form::open(array('name' => 'cameraPicture', 'url' => 'setMyStoryPicture', 'enctype' => 'multipart/form-data')) }}
					{{ csrf_field() }}
					<input id="captureUser" name="image" type="file" accept="image/*" capture="user" />
				{{ Form::close() }}
			</div>
      	</div>
		
		<div class="views">
			<div class="tutorial" style="font-size:2vh;">
				
				<hr class="noBorder" />
				
				<p>
					Parce que vous aussi vous avez une St(or)y à raconter
				</p>
				
				<p>
					Parce que vous aussi vous avez une histoire qui vaut la peine d'être lue
				</p>
				
				<hr class="noBorder" />
				
				<p style="text-align:left;">
					Créez votre story :
					<div class="row" style="text-align:left;">
						<div class="col-xs-1">1.</div><div class="col-xs-11">Choisissez une photo en lien avec l’histoire que vous souhaitez partager !</div>
						<div class="col-xs-1">2.</div><div class="col-xs-11">Ajouter à votre photo, l'anecdote que vous voulez raconter.</div>
						<div class="col-xs-1">3.</div><div class="col-xs-11">Publiez ! </div>
						<div class="col-xs-1">4.</div><div class="col-xs-11">À partir du 24 juin, vous aurez accès à l'ensemble des stories et pourrez liker les plus inspirantes !</div>
					</div>
				</p>
				<!-- Raconte nous ton Histoire d'Or ! -->
				
				<hr class="noBorder" />
				
				<p style="font-size:3vh;font-weight:bold;color:#c10927">
					On a tous une belle histoire à écrire
				</p>
			</div>
			
			<div id="galleryResult" class="galleryResult outofviewport" style="width: 100vw; height: 100%; display: flex; align-items: center; justify-content: center;margin-left:-15px;margin-right:-15px">
				<!-- <div class="fitContent">
					<img id="galleryPicture" src="#" alt="your image" width="100%" />
				</div> -->
			</div>
			
			<div id="captureResult" class="captureResult outofviewport" style="width: 100vw; height: 100%; display: flex; align-items: center; justify-content: center;margin-left:-15px;margin-right:-15px">
				<!-- <div class="fitContent">
					<img id="cameraPicture" src="#" alt="your image" width="100%" />
				</div> -->
			</div>
		</div>
		
		<div class="row galleryArea outofviewport">
			<span style="font-size:2vh;"> <b> (Recadrage disponible après validation) </b> </span>
			<div class="col-xs-12"> 
				<a id="galleryUserTrigger" href="#" _onclick="performClick('galleryUser');">
					<ion-icon name="images"></ion-icon>
				</a>
			</div>
		</div>
		
		<div class="row captureArea outofviewport">
			<span style="font-size:2vh;"> <b> (Recadrage disponible après validation) </b> </span>
			<div class="col-xs-12"> 
				<a id="captureUserTrigger" href="#" _onclick="performClick('captureUser');">
					<ion-icon name="camera"></ion-icon>
				</a>
			</div>
		</div>
	</div>
</div>

<script>
	function performClick(elemId) {
	   var elem = document.getElementById(elemId);
	   if(elem && document.createEvent) {
		  var evt = document.createEvent("MouseEvents");
		  evt.initEvent("click", true, false);
		  elem.dispatchEvent(evt);
	   }
	}
	
	function readURL(input, id) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				// $('#cameraPicture').attr('src', e.target.result);
				$('#' + id).attr('src', e.target.result);
			}
			// console.log(input.files[0]);

			reader.readAsDataURL(input.files[0]);
		}
	}
	
	// header interactions
	$(document).on('click', '.header .confirm', function(){
		$("#loaderWrapper").css('display', 'flex');
		if($('.picture.gallery').hasClass('active')){
			$("form[name='galleryPicture']").submit();
		} else if($('.picture.camera').hasClass('active')){
			$("form[name='cameraPicture']").submit();
		}
	});
	
	// footer interactions
	$(document).on('click', '.picture.gallery', function(){
		// 
		if($("#galleryUser").val() == ""){
			performClick('galleryUser');
		}
		
		// 
		$('.picture.active').removeClass('active');
		$(this).addClass('active');
		
		// 
		if($('.galleryArea').hasClass('outofviewport')){ $('.galleryArea').removeClass('outofviewport') }
		if(!$('.captureArea').hasClass('outofviewport')){ $('.captureArea').addClass('outofviewport') }
		// 
		if(!$('.views .tutorial').hasClass('outofviewport')){ $('.views .tutorial').addClass('outofviewport') }
		if(!$('.views .captureResult').hasClass('outofviewport')){ $('.views .captureResult').addClass('outofviewport') }
		
		// display view
		if($("#galleryUser").val() == ""){
			// confirm
			$(".header .confirm").hide();
		} else{
			if($('.views .galleryResult').hasClass('outofviewport')){ $('.views .galleryResult').removeClass('outofviewport') }
			// confirm
			$(".header .confirm").show();
		}
	});
	$(document).on('click', '.picture.camera', function(){
		// 
		if($("#captureUser").val() == ""){
			performClick('captureUser');
		}
		
		// 
		$('.picture.active').removeClass('active');
		$(this).addClass('active');
		
		//
		if(!$('.galleryArea').hasClass('outofviewport')){ $('.galleryArea').addClass('outofviewport') }
		if($('.captureArea').hasClass('outofviewport')){ $('.captureArea').removeClass('outofviewport') }
		// 
		if(!$('.views .tutorial').hasClass('outofviewport')){ $('.views .tutorial').addClass('outofviewport') }
		if(!$('.views .galleryResult').hasClass('outofviewport')){ $('.views .galleryResult').addClass('outofviewport') }
			
		// display view
		if($("#captureUser").val() == ""){
			// confirm
			$(".header .confirm").hide();
		} else{
			if($('.views .captureResult').hasClass('outofviewport')){ $('.views .captureResult').removeClass('outofviewport') }
			// confirm
			$(".header .confirm").show();
		}
	});
	
	// capture interaction
	$(document).on('click', '#galleryUserTrigger', function(){
		performClick('galleryUser');
	});
	$(document).on('click', '#captureUserTrigger', function(){
		performClick('captureUser');
	});
	
	// 
	$(document).on('change', '#galleryUser', function(e){
		if(!$('.views .tutorial').hasClass('outofviewport')){ $('.views .tutorial').addClass('outofviewport') }
		if($('.views .galleryResult').hasClass('outofviewport')){ $('.views .galleryResult').removeClass('outofviewport') }
		if(!$('.views .captureResult').hasClass('outofviewport')){ $('.views .captureResult').addClass('outofviewport') }
		// confirm
		$(".header .confirm").show();
		
		// navigator check
		var ua = navigator.userAgent.toLowerCase(); 
		
		loadImage(
			e.target.files[0],
			function (img, data) {
				// alert("before");
				if(data.exif != null){ console.log(data.exif);
					var orientation = data.exif.get('Orientation');
					
					// navigator check
					if (ua.indexOf('safari') != -1) {
						if (ua.indexOf('chrome') > -1) {
							// alert("chrome") // Chrome
							if(orientation != null){
								img.setAttribute('width', 'auto');
								img.setAttribute('height', 'auto');
								img.setAttribute('class', 'exifOrientation'+orientation);
							} else{
								img.setAttribute('width', 'auto');
								img.setAttribute('height', 'auto');
								img.setAttribute('class', 'exifOrientation0');
							}
						} else {
							// alert("safari") // Safari
							img.setAttribute('style', 'width:auto;height:auto;max-width:100%;max-height:100%');
							img.setAttribute('class', 'exifOrientationSafari');
						}
					}
				} else{
					// alert("no exif");
					if (ua.indexOf('safari') != -1) {
						if (ua.indexOf('chrome') > -1) {
							// alert("chrome") // Chrome
							img.setAttribute('width', 'auto');
							img.setAttribute('height', 'auto');
							img.setAttribute('class', 'exifOrientation0');
						} else {
							// alert("safari") // Safari
							img.setAttribute('style', 'width:auto;height:auto;max-width:100%;max-height:100%');
							img.setAttribute('class', 'exifOrientationSafari');
						}
					}
				}
				
				img.setAttribute('style', 'width:100%;height:100%;object-fit:cover;object-position:center;');
				
				// alert("after");
				document.getElementById('galleryResult').innerHTML = '';
				document.getElementById('galleryResult').appendChild(img);
			},
			{
				// orientation: 1,
				meta: true
			}
		);
	});
	
	$(document).on('change', '#captureUser', function(e){
		if(!$('.views .tutorial').hasClass('outofviewport')){ $('.views .tutorial').addClass('outofviewport') }
		if(!$('.views .galleryResult').hasClass('outofviewport')){ $('.views .galleryResult').addClass('outofviewport') }
		if($('.views .captureResult').hasClass('outofviewport')){ $('.views .captureResult').removeClass('outofviewport') }
		// confirm
		$(".header .confirm").show();
		
		// navigator check
		var ua = navigator.userAgent.toLowerCase(); 
		
		loadImage(
			e.target.files[0],
			function (img, data) {
				// alert("before");
				if(data.exif != null){
					var orientation = data.exif.get('Orientation');
					
					// navigator check
					if (ua.indexOf('safari') != -1) {
						if (ua.indexOf('chrome') > -1) {
							// alert("chrome") // Chrome
							if(orientation != null){
								img.setAttribute('width', 'auto');
								img.setAttribute('height', 'auto');
								img.setAttribute('class', 'exifOrientation'+orientation);
							} else{
								img.setAttribute('width', 'auto');
								img.setAttribute('height', 'auto');
								img.setAttribute('class', 'exifOrientation0');
							}
						} else {
							// alert("safari") // Safari
							img.setAttribute('style', 'width:auto;height:auto;max-width:100%;max-height:100%');
							img.setAttribute('class', 'exifOrientationSafari');
						}
					}
				} else{
					// alert("no exif");
					if (ua.indexOf('safari') != -1) {
						if (ua.indexOf('chrome') > -1) {
							// alert("chrome") // Chrome
							img.setAttribute('width', 'auto');
							img.setAttribute('height', 'auto');
							img.setAttribute('class', 'exifOrientation0');
						} else {
							// alert("safari") // Safari
							img.setAttribute('style', 'width:auto;height:auto;max-width:100%;max-height:100%');
							img.setAttribute('class', 'exifOrientationSafari');
						}
					}
				}
				
				// width: 100%;
				// height: 100%;
				// object-fit: cover
				
				img.setAttribute('style', 'width:100%;height:100%;object-fit:cover;object-position:center;');
				
				// alert("after");
				document.getElementById('captureResult').innerHTML = '';
				document.getElementById('captureResult').appendChild(img);
				// console.log(img);
				// console.log(img.src);
				// $("#captureResult").css('background-image', 'url('+img.src+')');
			},
			{
				// orientation: 1,
				meta: true
			}
		);
	});
	// gallery interaction

	$(document).ready(function(){
		
	});
</script>

@stop