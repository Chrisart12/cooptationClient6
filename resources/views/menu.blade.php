@extends('layout.gallerylayout')

@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		
	?>
	{{-- scrollable row text-center--}}
	<div id="navbar-menu" class="navbar-menu">
		<div class="container-menu" id="menu">
			<div class="links-menu">
				<a href="{{ url('gallery') }}">
					GALERIE
				</a>
			</div>
			<div class="links-menu">
					<a href="{{ url('cgu') }}">CGU</a>	
			</div>
					
			<div class="links-menu">
					<a href="{{ url('offres')}}">OFFRES</a>
			</div>
			<div class="links-menu deconnect">
				<a href="{{ url('/logout')}}">SE DECONNECTER</a>
			</div>
				
		</div>
	</div>

@stop

