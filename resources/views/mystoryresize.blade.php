@extends('layout.mystoryresizelayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row story">
	<div class="col-xs-12 content">
		<div id="box" class="box" style="background-image: url('{{ Config::get('custom.project_url') }}resources/pictures/{{ Auth::user()->story->user()->token }}/{{ Auth::user()->story->picture_path }}');">
			<div style="background-color:transparent;color:#FFFFFF;height: 100%;width: 100%;display: flex; flex-direction: column;font-size:10vh;">
				<div id="top">
					<ion-icon id="alignTop" onClick="return true;" name="arrow-dropup"></ion-icon>
				</div>
				<div id="center" style="flex-grow: 1;align-items: center;justify-content: center;display: flex;">
					<div style="display:flex;flex-grow:1;justify-content:flex-start;">
						<ion-icon id="alignLeft" onClick="return true;" name="arrow-dropleft"></ion-icon>
					</div>
					<div style="display:flex;flex-grow:1;justify-content:center;">
						<ion-icon id="alignCenter" onClick="return true;" name="radio-button-on"></ion-icon>
					</div>
					<div style="display:flex;flex-grow:1;justify-content:flex-end;">
						<ion-icon id="alignRight" onClick="return true;" name="arrow-dropright"></ion-icon>
					</div>
				</div>
				<div id="bottom" style="display: flex;align-items: end;justify-content: center;">
					<ion-icon id="alignBottom" onClick="return true;" name="arrow-dropdown"></ion-icon>
				</div>
			</div>
		</div>
		
		<div style="height:14vh;">
			<div style="display:flex;width:100%;height:100%;font-size:3vh;align-items:center;justify-content:center;-webkit-touch-callout:none;
-webkit-user-select:none;
-khtml-user-select:none;
-moz-user-select:none;
-ms-user-select:none;
user-select:none;
-webkit-tap-highlight-color:rgba(0,0,0,0);">
				Recadrez votre image si nécessaire
			</div>
			
			<br />
			
			{{ Form::open(array('name' => 'myStoryResize', 'url' => 'setMyStoryResize')) }}
				{{ csrf_field() }}
				<input type="text" name="bgPositionX" id="bgPositionX" value="center" style="display:none;" />
				<input type="text" name="bgPositionY" id="bgPositionY" value="center" style="display:none;" />
			{{ Form::close() }}
		</div>
	</div>
</div>

<script>
	// resize interactions
	/*$(document).on('click', '#alignTop', function(){
		// alert("align top");
		$('#box').css('background-position-y', 'top');
		$('#bgPositionY').val('top');
	});
	$(document).on('click', '#alignLeft', function(){
		// alert("align left");
		$('#box').css('background-position-x', 'left');
		$('#bgPositionX').val('left');
	});*/
	$(document).on('click', '#alignCenter', function(){
		// alert("align center");
		/*$('#box').css('background-position-x', 'center');
		$('#box').css('background-position-y', 'center');
		$('#bgPositionX').val('center');
		$('#bgPositionY').val('center');*/
		$('#box').css('background-position-x', '50%');
		$('#box').css('background-position-y', '50%');
		$('#bgPositionX').val('50%');
		$('#bgPositionY').val('50%');
	});
	/*$(document).on('click', '#alignRight', function(){
		// alert("align right");
		$('#box').css('background-position-x', 'right');
		$('#bgPositionX').val('right');
	});
	$(document).on('click', '#alignBottom', function(){
		// alert("align bottom");
		$('#box').css('background-position-y', 'bottom');
		$('#bgPositionY').val('bottom');
	});*/
	
	/** TOP **/
	var pressTop = false;
	var scrollTop = setInterval(function(){ 
		if(pressTop){ 
			var y = parseInt($('#box').css('background-position-y').replace('%',''));
			if(y > 0){
				y -= 1;
			}
			$('#box').css('background-position-y', y+'%');
			$('#bgPositionY').val(y+'%');
		}
	}, 50);
	/*$(document).on('mousedown', '#alignTop', function(){ pressTop = true; });
	$(document).on('mouseup', '#alignTop', function(){ pressTop = false; });*/
	
	/** LEFT **/
	var pressLeft = false;
	var scrollLeft = setInterval(function(){ 
		if(pressLeft){ 
			var x = parseInt($('#box').css('background-position-x').replace('%',''));
			if(x > 0){
				x -= 1;
			}
			$('#box').css('background-position-x', x+'%');
			$('#bgPositionX').val(x+'%');
		}
	}, 50);
	/*$(document).on('mousedown', '#alignLeft', function(){ pressLeft = true; });
	$(document).on('mouseup', '#alignLeft', function(){ pressLeft = false; });*/
	
	/** RIGHT **/
	var pressRight = false;
	var scrollRight = setInterval(function(){ 
		if(pressRight){ 
			var x = parseInt($('#box').css('background-position-x').replace('%',''));
			if(x < 100){
				x += 1;
			}
			$('#box').css('background-position-x', x+'%');
			$('#bgPositionX').val(x+'%');
		}
	}, 50);
	/*$(document).on('mousedown', '#alignRight', function(){ pressRight = true; });
	$(document).on('mouseup', '#alignRight', function(){ pressRight = false; });*/
	
	/** BOTTOM **/
	var pressBottom = false;
	var scrollBottom = setInterval(function(){ 
		if(pressBottom){ 
			var y = parseInt($('#box').css('background-position-y').replace('%',''));
			if(y < 100){
				y += 1;
			}
			$('#box').css('background-position-y', y+'%');
			$('#bgPositionY').val(y+'%');
		}
	}, 50);
	/*$(document).on('mousedown', '#alignBottom', function(){ pressBottom = true; });
	$(document).on('mouseup', '#alignBottom', function(){ pressBottom = false; });*/
	
	
	$(document).ready(function () {
		var isTouchDevice = 'ontouchstart' in document.documentElement;
		
		/** TOP **/
		$("#alignTop").mousedown(function(event) { if (isTouchDevice == false) { pressTop = true; } });
		$("#alignTop").mouseup(function(event) { if (isTouchDevice == false) { pressTop = false; } });
		$('#alignTop').on('touchstart', function(){ if (isTouchDevice)  { pressTop = true; } });
		$('#alignTop').on('touchend', function(){ if (isTouchDevice)  { pressTop = false; } });
		
		/** LEFT **/
		$("#alignLeft").mousedown(function(event) { if (isTouchDevice == false) { pressLeft = true; } });
		$("#alignLeft").mouseup(function(event) { if (isTouchDevice == false) { pressLeft = false; } });
		$('#alignLeft').on('touchstart', function(){ if (isTouchDevice)  { pressLeft = true; } });
		$('#alignLeft').on('touchend', function(){ if (isTouchDevice)  { pressLeft = false; } });
		
		/** RIGHT **/
		$("#alignRight").mousedown(function(event) { if (isTouchDevice == false) { pressRight = true; } });
		$("#alignRight").mouseup(function(event) { if (isTouchDevice == false) { pressRight = false; } });
		$('#alignRight').on('touchstart', function(){ if (isTouchDevice)  { pressRight = true; } });
		$('#alignRight').on('touchend', function(){ if (isTouchDevice)  { pressRight = false; } });
		
		/** BOTTOM **/
		$("#alignBottom").mousedown(function(event) { if (isTouchDevice == false) { pressBottom = true; } });
		$("#alignBottom").mouseup(function(event) { if (isTouchDevice == false) { pressBottom = false; } });
		$('#alignBottom').on('touchstart', function(){ if (isTouchDevice)  { pressBottom = true; } });
		$('#alignBottom').on('touchend', function(){ if (isTouchDevice)  { pressBottom = false; } });
	});
	
	
	
	/*$(document).ready(function () {
		var isTouchDevice = 'ontouchstart' in document.documentElement;
		
		$("#alignCenter").mousedown(function(event) {
			if (isTouchDevice == false) {   
				// pushed();   
				alert();
			}
		});
		$("#alignCenter").mouseup(function(event) {
			if (isTouchDevice == false) {   
				// released(); 
				alert();
			}
		});
		$('#alignCenter').on('touchstart', function(){
			if (isTouchDevice)  {   
				// pushed();   
				console.log("pushed");
			}
		});
		$('#alignCenter').on('touchend', function(){
			if (isTouchDevice)  {   
				// released(); 
				console.log("released");
			}
		});
	});*/
	
	// header interactions
	$(document).on('click', '.header .confirm', function(){
		$("form[name='myStoryResize']").submit();
	});
</script>

@stop