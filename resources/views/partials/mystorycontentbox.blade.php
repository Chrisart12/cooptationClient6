<div class="box">
	<div class="fitContent">
		{{-- <img id="picture" width="100%" src="{{ Config::get('custom.project_url') }}resources/pictures/{{ $story->user()->token }}/{{ $story->picture_path }}" /> --}}
	</div>
		
	<div class="myStoryContent">
		{{ Form::open(array('name' => 'myStoryContent', 'url' => 'setMyStoryContent')) }}
			{{ csrf_field() }}
			<textarea id="myStoryContent" name="myStoryContent" placeholder="Exprimez vous !"></textarea>
		{{ Form::close() }}
	</div>
</div>