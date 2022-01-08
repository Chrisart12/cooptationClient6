@extends('admin.layout.gallerylayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row gallery">
	<div class="col-xs-12 content">
		<div class="row stories">
			@foreach($stories as $story)
				<div class="col-xs-6 col-sm-6  col-md-4  col-lg-3 storyBox">
					<a href="{{ $baseUrl }}/admin/story/{{ $story->id }}">
						<div class="story" style="background-position-x:{{ $story->bg_position_x }};background-position-y:{{ $story->bg_position_y }};background-image: url('{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}');">
							<div class="fullname">
								{{ $story->user()->getFullname() }}
								@if($story->is_demo)
									(démo)
								@endif
							</div>
							<div class="like">
								<ion-icon name="heart"></ion-icon>
							</div>
							<div class="likeCount">
								<b>{{ $story->likes_count }}</b>
							</div>
						</div>
					</a>
				</div>
			@endforeach
      	</div>
	</div>
</div>

<script>
	$(document).on('click', '#top30', function(){
		if($('#isTop30').is(":checked")){
			// alert('checked');
			$('#isTop30').prop('checked', false);
		} else{
			// alert('unchecked');
			$('#isTop30').prop('checked', true);
		}
		$('form[name="filter"]').submit();
	});
</script>

@stop