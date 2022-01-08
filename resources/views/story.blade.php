@extends('layout.storylayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row story">
	<div style="height: 4vh;font-size:2.5vh;margin-top: 1vh;text-align:center;">
		{!! $story->user()->getFullname() !!}
	</div>
	<div class="col-xs-12 content">
		<div class="box" style="background-position-x:{{ $story->bg_position_x }};background-position-y:{{ $story->bg_position_y }};background-image: url('{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}');">
			<div style="width: 100%;">
				<div id="like" style="height: 50%; display:flex; align-items: center;justify-content: center;font-size:5vh; color: #c10927;justify-content:flex-start;flex-grow:1;padding: 1vh;">
					@if($story->hasLikeFromUser(Auth::user()->id))
						<ion-icon id="icon" name="heart" onClick="like()"></ion-icon>
					@else
						<ion-icon id="icon" name="heart-empty" onClick="like()"></ion-icon>
					@endif
				</div>
			</div>
		</div>
		<!-- <div style="background-color: #FFFFFF; width: 100%; height: 20vh; position: fixed; bottom: 0;margin-bottom: 8vh;"> -->
		<div>
			<!-- <div style="text-align: left;overflow: hidden; overflow-y: scroll; height: 20vh; padding: 0 2vh; font-size:1.75vh;"> -->
			<div class="text" style="text-align: left;padding: 0 2vh; ">
				{!! $story->getStory() !!}
			</div>
		</div>
		<div id="logo" style="display: flex;align-items: center;justify-content: flex-end;padding: 1vh; position: fixed;right: 1vh;bottom: 8vh;">
			<img style="height:5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/logo_color.png" />
		</div>
	</div>
</div>

<script>
	// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
	let vh = window.innerHeight * 0.01;
	// Then we set the value in the --vh custom property to the root of the document
	document.documentElement.style.setProperty('--vh', `${vh}px`);
</script>

<script>
	// variables
	var baseUrl = "<?php echo $baseUrl; ?>";
	var userId = <?php echo Auth::user()->id; ?>;
	var storyId = <?php echo $story->id; ?>;

	// action de like / delike
	var like = function() {
		//  
		likeStory(userId, storyId);
	}
	
	// 
	var likeStory = function(userId, storyId){
		var data = {
			userId: userId,
			storyId: storyId
		}
		  
		data = JSON.stringify(data);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$.ajax({
			type: "POST",
			url: baseUrl + "/updateLike",
			// url: "updateLike",
			data: data,
			contentType: 'application/json',
			success: function(data) {
				// on masque le popup d'ajout de nouveau support
				if(data['status'].length > 0){
					if(data['status'] == "success"){
						// message de retour après succès
						var like = data['data'];
						//On met à jour l'icône de like en fonction du retour
						if(like == "creation"){
							$('#like #icon').attr('name', 'heart');
						} else{
							$('#like #icon').attr('name', 'heart-empty');
						}
					} else{
						alert(data['message']);
					}
				}
			},
			error: function( data, status, err ) {
				// alert(ucfirst(jsLang['label']['errorOccuredDuringLessonSupportSave']));
				alert("Une erreur est survenue.");
			},
		});
	}
</script>

@stop