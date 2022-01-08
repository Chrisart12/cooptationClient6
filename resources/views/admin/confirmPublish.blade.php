@extends('admin.layout.cooptationlayout')

@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		$title = 'CONFIRMATION';
	?>

	<div class=" pages">
		<table class="container">
			<div class="bouton">
				<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
				<a href="{{route('admin.offres.create')}}"><button class="voir">PUBLIER</button></a>
			</div>
			<center class="listeCooptation">
				<P>Votre annonce Réf : {{ $offre->reference }} a été bien publiée.</P>
			</center>

			
	</div>


@stop