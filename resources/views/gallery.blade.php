@extends('layout.gallerylayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row gallery">
	<div class="col-xs-12 content">
		<div class="row stories">
			@if(isset($firstConnection) && $firstConnection)
				<div class="col-xs-12 lastStories">
					{{ ucfirst(Lang::get('label.last-stories')) }}
				</div>
			@endif
			@if(count($stories) > 0)
				@foreach($stories as $story)
					<div class="col-xs-6 col-sm-6 storyBox">
						<a href="story/gallery/{{ $story->id }}">
							<div class="story" style="background-position-x:{{ $story->bg_position_x }};background-position-y:{{ $story->bg_position_y }};background-image: url('{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}');">
								<!-- <a href="story/gallery/{{ $story->id }}">
									@include('partials.gallerybox', ['story'=>$story])
								</a> -->
								<div class="fullname">
									{{ $story->user()->getFullname() }}
								</div>
								<div class="like">
									@if($story->hasLikeFromUser(Auth::user()->id))
										<ion-icon name="heart"></ion-icon>
									@else
										<ion-icon name="heart-empty" onClick="like()"></ion-icon>
									@endif
								</div>
							</div>
						</a>
					</div>
				@endforeach
				
				<!-- <div id="loaderWrapper" style="width: 100vw; height: 10vh; font-size: 4vh; padding-bottom:-1vh; background-color: rgba(255,255,255,1); display:flex; align-items: center; justify-content: center;">
					<ion-icon name="refresh"></ion-icon>
				</div> -->
			@endif
			
			@if(isset($lastStories) && isset($oldStories))
				@if(count($lastStories) > 0)
					<div class="col-xs-12 lastStories">
						{{ ucfirst(Lang::get('label.last-stories')) }}
					</div>
					
					@foreach($lastStories as $story)
						<div class="col-xs-6 col-sm-6 storyBox">
							<a href="story/gallery/{{ $story->id }}">
								<div class="story" style="background-position-x:{{ $story->bg_position_x }};background-position-y:{{ $story->bg_position_y }};background-image: url('{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}');">
									<div class="fullname">
										{{ $story->user()->getFullname() }}
									</div>
									<div class="like">
										@if($story->hasLikeFromUser(Auth::user()->id))
											<ion-icon name="heart"></ion-icon>
										@else
											<ion-icon name="heart-empty" onClick="like()"></ion-icon>
										@endif
									</div>
								</div>
							</a>
						</div>
					@endforeach
				@endif
				
				@if(count($oldStories) > 0)
					@if(count($lastStories) > 0)
						<div class="col-xs-12 oldStories">
							{{ ucfirst(Lang::get('label.old-stories')) }}
						</div>
					@endif
					
					@foreach($oldStories as $story)
						<div class="col-xs-6 col-sm-6 storyBox">
							<a href="story/gallery/{{ $story->id }}">
								<div class="story" style="background-position-x:{{ $story->bg_position_x }};background-position-y:{{ $story->bg_position_y }};background-image: url('{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}');">
									<div class="fullname">
										{{ $story->user()->getFullname() }}
									</div>
									<div class="like">
										@if($story->hasLikeFromUser(Auth::user()->id))
											<ion-icon name="heart"></ion-icon>
										@else
											<ion-icon name="heart-empty" onClick="like()"></ion-icon>
										@endif
									</div>
								</div>
							</a>
						</div>
					@endforeach
				@endif
			@endif
			
			<!-- <div class="col-xs-12"> 
				http://jquery.eisbehr.de/lazy/example_basic-usage
			</div> -->
      	</div>
	</div>
</div>

<script>
	var baseUrl = "<?php echo $baseUrl; ?>";
	var userId = <?php echo Auth::user()->id; ?>;
	var storyCount = <?php echo $storyCount; ?>;
	var search = "<?php if(isset($search)){ echo $search; } else{ echo ""; } ?>";
	var picturesUrl = "<?php echo Config::get('custom.project_url').'resources/pictures/'; ?>";
</script>

<script>
	$('.stories').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
			getMoreStories();
        }
    });
</script>

<script>
	var getMoreStories = function(){
		var data = {
			userId: userId,
			storyCount: storyCount,
			search: search
		}
		// console.log(data);
		data = JSON.stringify(data);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$.ajax({
			type: "POST",
			url: baseUrl + "/getMoreStories",
			// url: "updateLike",
			data: data,
			contentType: 'application/json',
			success: function(data) {
				// on masque le popup d'ajout de nouveau support
				if(data['status'].length > 0){
					if(data['status'] == "success"){
						// message de retour après succès
						var stories = data['data']['stories'];
						// 
						storyCount += stories.length;
						
						if(stories.length > 0){
							for(var s=0;s<stories.length;s++){
								var story = stories[s];
								var str = '';
								str += '<div class="col-xs-6 col-sm-6 storyBox">';
									str += '<a href="story/gallery/'+story['story_id']+'">';
										str += '<div class="story" style="background-position-x:' + story['bg_position_x'] + ';background-position-y:' + story['bg_position_y'] + ';background-image: url(' + picturesUrl + story['token'] + '/' + story['picture_path'] + ');">';
											str += '<div class="fullname">';
												str += story['firstname'] + ' ' + story['lastname'];
											str += '</div>';
											str += '<div class="like">';
												if(story['likes_count'] > 0){
													str += '<ion-icon name="heart"></ion-icon>';
												} else{
													str += '<ion-icon name="heart-empty" onClick="like()"></ion-icon>';
												}
											str += '</div>';
										str += '</div>';
									str += '</a>';
								str += '</div>';

								// append stories
								$('.stories').append(str);
								// $('#loaderWrapper').before(str);
							}
						} else{
							// $('#loaderWrapper').hide();
						}
						
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
	};
</script>

<script>
	$(document).on('click', '#openSearch', function(){
		$('#searchArea').addClass("flex");
		$('#openSearch').hide();
		$('#title').hide();
		$('#cgu').hide();
		
		$('#searchInput').focus();
	});
	$(document).on('click', '#search', function(){
		$("form[name='searchContributor']").submit();
	});
	$(document).on('click', '#closeSearch', function(){
		$('#searchArea').removeClass("flex");
		$('#openSearch').show();
		$('#title').show();
		$('#cgu').show();
	});
</script>

@stop