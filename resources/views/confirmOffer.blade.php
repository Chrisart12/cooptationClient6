@extends('layout.gallerylayout')

@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		
	?>
	<div class="scrollable">
		<div class=" pages_user_cooptation">
			<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
			<div class="row text-center">
				
					<p class="texte confirmOffer">Votre candidat {{ strtoupper($candidat->lastName) . ' ' . ucfirst($candidat->firstName) }} a été bien enregistré, nous vous remercions.</p>
					
			</div>
		</div>
	</div>

@stop