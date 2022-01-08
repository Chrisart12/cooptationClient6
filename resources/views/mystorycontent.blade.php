@extends('layout.mystorycontentlayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row story">
	<div class="col-xs-12 content">
		<!-- @include('partials.mystorycontentbox', ['story'=>Auth::user()->story]) -->
			
		<!-- <img id="picture" width="100%" src="{{ Config::get('custom.project_url') }}resources/pictures/{{ Auth::user()->story->user()->token }}/{{ Auth::user()->story->picture_path }}" /> -->
		
		<div class="box" style="background-position-x:{{ Auth::user()->story->bg_position_x }};background-position-y:{{ Auth::user()->story->bg_position_y }};background-image: url('{{ Config::get('custom.project_url') }}resources/pictures/{{ Auth::user()->story->user()->token }}/{{ Auth::user()->story->picture_path }}');"></div>
		
		<div class="myStoryContent" style="position: fixed; bottom: 0; left: 0; margin-bottom: 8vh;">
			<div id="leftChar" style="position: absolute; text-align: center; width: 100%; height: 3vh; line-height: 3vh; font-size: 2vh;"> (300 caractères restants) </div>
			{{ Form::open(array('name' => 'myStoryContent', 'url' => 'setMyStoryContent')) }}
				{{ csrf_field() }}
				<textarea id="myStoryContent" name="myStoryContent" placeholder="Rédigez votre story ici" style="height:40vh;border:0;padding-top:3vh;"></textarea>
			{{ Form::close() }}
		</div>
	</div>
</div>

<script>
	var max = 300;

	// A chaque changement de caractère
	$(document).on('keyup', '#myStoryContent', function(){
		if($(this).val() != "" && $(this).val().length >= 1){
			$('.confirm').show();
		} else{
			$('.confirm').hide();
		}
		// if($(this).val() != "" && $(this).val().length >= max){
			// $(this).val($(this).val().substring(0, max));
		// }
		
		var string = $(this).val().substring(0, max);
		var left = " (" + (max - string.length) + "caractères restants)";
		
		$(this).val(string);
		$("#leftChar").html(left);
	});
	
	// header interactions
	$(document).on('click', '.header .confirm', function(){
		$("form[name='myStoryContent']").submit();
	});
</script>

@stop