@extends('admin.layout.storylayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row story">
	<div class="col-xs-12 content">
		<div class="box" style="background-position-x:{{ $story->bg_position_x }};background-position-y:{{ $story->bg_position_y }};background-image: url('{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}');">
			<div class="fullname"> {{ $story->user()->getFullname() }} </div>
			<div class="like">
				<ion-icon name="heart"></ion-icon>
			</div>
			<div class="likeCount">
				<b>{{ count($story->likes) }}</b>
			</div>
			<div id="logo" style="position: absolute;bottom: 1vh;right: 1vh;">
				<img style="height:5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/logo_color.png" />
			</div>
		</div>
		
		<div class="infos">
			<div class="text"> {{ ucfirst(Lang::get('admin.region')) }} : {!! $story->user()->region()->label !!} </div>
			<div class="text"> {{ ucfirst(Lang::get('admin.responsible')) }} : {!! $story->user()->responsible()->label !!} </div>
			@if(Auth::user()->token == 'twinadmin')
				<div class="text" style="display:flex;padding-right:15px;height:100%;"> 
					<div id="storyContent" style="flex-grow:1;height:100%;">
						<div id="storyText" style="_display:none;">
							{!! $story->getStory() !!}
						</div>
						<div id="storyEdition" style="color:#000000;display:none;">
							<textarea name="storyEdition" style="width:95%;height:auto;">{!! $story->getStory() !!}</textarea>
						</div>
					</div>
					<div style="font-size:3vh;">
						<div>
							<div title="{{ mb_convert_case(Lang::get('admin.edit-story'), MB_CASE_TITLE, 'UTF-8') }}" id="editStory">
								<ion-icon name="create"></ion-icon>
							</div>
							<div title="{{ mb_convert_case(Lang::get('admin.update-story'), MB_CASE_TITLE, 'UTF-8') }}" id="validStory" style="display:none;">
								<ion-icon name="checkmark"></ion-icon>
							</div>
						</div>
						<div>
							<div title="{{ mb_convert_case(Lang::get('admin.disable-story'), MB_CASE_TITLE, 'UTF-8') }}" id="disableStory">
								<ion-icon name="trash"></ion-icon>
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="text" style="padding-right:15px;"> 
					{!! $story->getStory() !!}
				</div>
			@endif
		</div>
	</div>
</div>

<script>
	var height = $('#storyContent').height();
	$('textarea[name="storyEdition"]').height((height * 0.5));
	
	$(document).on('click', '#editStory', function(){
		$("#storyText").hide();
		$("#editStory").hide();
		$("#storyEdition").show();
		$("#validStory").show();
	});
	
	$(document).on('click', '#validStory', function(){
		$("#storyText").show();
		$("#editStory").show();
		$("#storyEdition").hide();
		$("#validStory").hide();
		
		
		
		//
		var story = $('textarea[name="storyEdition"]').val();
		// alert(story);
		editStory(userId, storyId, story);
	});
	
	$(document).on('click', '#disableStory', function(){
		var result = confirm('Désactiver la story ?');
		if(result){
			disableStory(userId, storyId);
		}
	});
</script>

<script>
	// variables
	var baseUrl = "<?php echo $baseUrl; ?>";
	var userId = <?php echo $story->user()->id; ?>;
	var storyId = <?php echo $story->id; ?>;
	
	// 
	var editStory = function(userId, storyId, story){
		var data = {
			userId: userId,
			storyId: storyId,
			story: story
		}
		  
		data = JSON.stringify(data);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$.ajax({
			type: "POST",
			url: baseUrl + "/admin/editStory",
			// url: "updateLike",
			data: data,
			contentType: 'application/json',
			success: function(data) {
				// on masque le popup d'ajout de nouveau support
				if(data['status'].length > 0){
					if(data['status'] == "success"){
						// mise à jour du texte
						$('#storyText').text(story);
						alert(data['message']);
					} else{
						alert(data['message']);
					}
				}
				
				// alert("success");
			},
			error: function( data, status, err ) {
				// alert(ucfirst(jsLang['label']['errorOccuredDuringLessonSupportSave']));
				alert("Une erreur est survenue.");
			},
		});
	}
	
	// 
	var disableStory = function(userId, storyId){
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
			url: baseUrl + "/admin/disableStory",
			// url: "updateLike",
			data: data,
			contentType: 'application/json',
			success: function(data) {
				// on masque le popup d'ajout de nouveau support
				if(data['status'].length > 0){
					if(data['status'] == "success"){
						// mise à jour du texte
						alert(data['message']);
					} else{
						alert(data['message']);
					}
				}
				
				// alert("success");
			},
			error: function( data, status, err ) {
				// alert(ucfirst(jsLang['label']['errorOccuredDuringLessonSupportSave']));
				alert("Une erreur est survenue.");
			},
		});
	}
</script>

@stop