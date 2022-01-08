<div class="box">
	<div class="fitContent">
		<div class="text">
			{!! $story->story !!}
		</div>
		
		<img id="picture" width="100%" src="{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}" />
		
		<div class="logo">
			<div id="logo">
				<img src="{{ Config::get('custom.project_url') }}resources/assets/img/logo_color.png" />
			</div>
		</div>
	</div>
</div>