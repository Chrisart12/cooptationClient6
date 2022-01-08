@extends('layout.gallerylayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row login">
	<div class="col-xs-12 content">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3"> 
				Gallery
			</div>
      	</div>
      
      	<hr />
      
      	<div class="row">
        	Choose
			<div class="col-xs-12 col-sm-6 col-sm-offset-3"> 
				<input type="file" accept="image/*;capture=camera">
			</div>
      	</div>
      
      	<hr />
      
      	<div class="row">
        	Gallery
			<div class="col-xs-12 col-sm-6 col-sm-offset-3"> 
				<input type="file" accept="image/*">
			</div>
      	</div>
      
      	<hr />
      
      	<div class="row">
        	Capture Camera
			<div class="col-xs-12 col-sm-6 col-sm-offset-3"> 
				<input type="file" accept="image/*" capture="camera" />
			</div>
      	</div>
      
      	<hr />
      
      	<div class="row">
        	Capture User
			<div class="col-xs-12 col-sm-6 col-sm-offset-3"> 
				<input id="captureUser" type="file" accept="image/*" capture="user" />
				<img id="blah" src="#" alt="your image" width="100%" />
			</div>
      	</div>
      
      	<hr />
		<a id="captureUserTrigger" href="#" onclick="performClick('captureUser');">Open file dialog</a>
      	<hr />
      
      	<div class="row">
        	Capture Environment
			<div class="col-xs-12 col-sm-6 col-sm-offset-3"> 
				<input type="file" accept="image/*" capture="environment" />
			</div>
		</div>
      	<hr />
      
      	<div class="row">
        	getUserMedia Test
          	<input type="button" value="Test" onClick="alert(hasGetUserMedia())" />
		</div>
      
      	<hr />
      
      	<div class="row">
        	<video autoplay></video>
			<img src="">
			<canvas style="display:none;"></canvas>
		</div>
      	<div class="row">
			<div id="screenshot" style="text-align:center;">
				<video class="videostream" autoplay=""></video>
				<img id="screenshot-img">
				<p><button class="capture-button">Capture video</button>
				</p><p><button id="screenshot-button">Take screenshot</button></p>
			</div>
		</div>
	</div>
</div>

<script>
	const captureVideoButton = document.querySelector('#screenshot .capture-button');
	const screenshotButton = document.querySelector('#screenshot-button');
	const img = document.querySelector('#screenshot img');
	const video = document.querySelector('#screenshot video');

	const canvas = document.createElement('canvas');
	
	const constraints = { 
		video: true 
		// video: {width: {exact: 640}, height: {exact: 480}}
	};

	captureVideoButton.onclick = function() {
		navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);
	};

	screenshotButton.onclick = video.onclick = function() {
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		canvas.getContext('2d').drawImage(video, 0, 0);
		// Other browsers will fall back to image/png
		img.src = canvas.toDataURL('image/webp');
	};

	function handleSuccess(stream) {
		screenshotButton.disabled = false;
		video.srcObject = stream;
	}
</script>

<script>
	function hasGetUserMedia() {
		return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
	}

	/*if (hasGetUserMedia()) {
		// Good to go!
		alert("good !!");
	} else {
		alert('getUserMedia() is not supported by your browser');
	}*/
</script>

<script>
	function performClick(elemId) {
	   var elem = document.getElementById(elemId);
	   if(elem && document.createEvent) {
		  var evt = document.createEvent("MouseEvents");
		  evt.initEvent("click", true, false);
		  elem.dispatchEvent(evt);
	   }
	}
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#blah').attr('src', e.target.result);
			}
			console.log(input.files[0]);

			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$(document).on('click', '#captureUser', function(){
		// alert("click");
	});
	$(document).on('change', '#captureUser', function(){
		// alert("click");
		// console.log($(this));
		readURL(this);
	});

	$(document).ready(function(){
		// eventFire(document.getElementById('captureUser'), 'click');
		// $("#captureUser").trigger("click");
		// $("#captureUserTrigger").trigger("click");
	});
</script>

@stop