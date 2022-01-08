@extends('layout.mystoryvalidationlayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row story">
	<div class="col-xs-12 content">
		{{ Form::open(array('name' => 'myStoryValidation', 'url' => 'setMyStoryValidation')) }}
			{{ csrf_field() }}
		{{ Form::close() }}
		<div style="font-size:2.5vh;margin-top: 1vh">
			{!! Auth::user()->getFullname() !!}
		</div>
		<div class="box" style="background-position-x:{{ Auth::user()->story->bg_position_x }};background-position-y:{{ Auth::user()->story->bg_position_y }};background-image: url('{{ Config::get('custom.project_url') }}resources/pictures/{{ Auth::user()->token }}/{{ Auth::user()->story->picture_path }}');">
			<!-- <div style="width: 100%;position: absolute;bottom: 0;display: flex;padding: 2vh;">
				<div id="like" style="height: 50%; display:flex; align-items: center;justify-content: center;font-size:5vh; color: #c10927;justify-content:flex-start;flex-grow:1;padding: 1vh;">
				</div>
				<div id="logo" style="height: 50%; display:flex; align-items: center;justify-content: center;justify-content: flex-end;flex-grow:1;padding: 1vh;">
					<img style="height:5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/logo_color.png" />
				</div>
			</div> -->
			<div style="background-color: #FFFFFF; width: 100%; height: 20vh; position: fixed; bottom: 0;margin-bottom: 8vh;">
				<div class="row">
					<div class="col-xs-12">
						<!-- <div style="font-size:2.5vh">
							{!! Auth::user()->getFullname() !!}
						</div> -->
						<div style="text-align: left;overflow: hidden; overflow-y: scroll; height: 18vh; padding: 0 2vh; font-size:1.75vh;">
							{!! Auth::user()->story->getStory() !!}
						</div>
					</div>
				</div>
				<div id="logo" style="display: flex;align-items: center;justify-content: flex-end;padding: 1vh; position: fixed;right: 1vh;bottom: 8vh;">
					<img style="height:5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/logo_color.png" />
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '.mystory .validation', function(){
		var answer = confirm('Vous êtes sur le point de valider définitivement votre st(or)y. \r\n Continuer ?');
		if(answer){
			$("form[name='myStoryValidation']").submit();
		}
	});
</script>

@stop