@extends('layout.gallerylayout')

@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		
	?>
	<div class="scrollable">
		<div class="offres pages_user_cooptation">
			<div class="coopterBouton">
				<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
				<a href="{{url('offer'. '/' . $offre->id)}}"><button class="voir">COOPTER</button></a>
			</div>
			<br>
		 	<h4 class="text-center">{{ $offre->poste }}</h4>
				<div>
				    <p>{{ $offre->lieu }}</p>
					<p>Réf : {{ $offre->reference }}</p>
					<p class="offres_description">{{ $offre->description }}</p>
				</div>
		</div>
	</div>

@stop