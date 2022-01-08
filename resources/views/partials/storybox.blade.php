<div class="box">
	<div class="fitContent">
		<div class="text">
			{!! $story->story !!}
		</div>
		
		<img id="picture" width="100%" src="{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}" />
		
		<div class="logo">
			<div id="like">
				@if($story->hasLikeFromUser(Auth::user()->id))
					<ion-icon id="icon" name="heart" onClick="like()"></ion-icon>
				@else
					<ion-icon id="icon" name="heart-empty" onClick="like()"></ion-icon>
				@endif
			</div>
			<div id="logo">
				<img src="{{ Config::get('custom.project_url') }}resources/assets/img/logo_color.png" />
			</div>
		</div>
	</div>
</div>