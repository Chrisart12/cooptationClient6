@extends('layout.gallerylayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row gallery">
	<div class="col-xs-12 content">
		<div class="row stories">
			@foreach($stories as $story)
				<div class="col-xs-6 col-sm-6 _story">
					<div class="story">
						<a href="story/gallery/{{ $story->id }}">
							@include('partials.gallerybox', ['story'=>$story])
						</a>
					</div>
				</div>
			@endforeach
			<!-- <div class="col-xs-12"> 
				http://jquery.eisbehr.de/lazy/example_basic-usage
			</div> -->
      	</div>
	</div>
</div>

@stop