@extends('layout.favoritelayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row favorite">
	<div class="col-xs-12 content">
		<div class="row stories">
			@foreach($stories as $story)
				<div class="col-xs-6 col-sm-6 storyBox">
					<!-- <div class="story">
						<a href="story/favorite/{{ $story->id }}">
							@include('partials.gallerybox', ['story'=>$story])
						</a>
					</div> -->
					<a href="story/favorite/{{ $story->id }}">
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
      	</div>
	</div>
</div>

@stop