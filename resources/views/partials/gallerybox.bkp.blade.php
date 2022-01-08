<div class="box">
<div></div>
	<div class="fullname">
		{{ $story->user()->getFullname() }}
	</div>
	<img src="{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}" />
	<div class="like">
		@if($story->hasLikeFromUser(Auth::user()->id))
			<ion-icon name="heart"></ion-icon>
		@else
			<ion-icon name="heart-empty" onClick="like()"></ion-icon>
		@endif
	</div>
</div>