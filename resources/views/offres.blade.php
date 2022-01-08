@extends('layout.offreslayout')

@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		
	?>
	<div class="scrollable">
		<div class="offres pages_user_cooptation">
			{{-- <a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a> --}}
			<br>
			<br>
		 	<h4 class="text-center">LES OFFRES D'EMPLOI SUR MaStory</h4>
					@foreach($offres as $offre)
						<div class="textes_user_offres">
							<p>{{ $offre->lieu }}</p>
							<p>Réf : {{ $offre->reference }}</p>
							{{-- <p>Catégorie : {{ $offre->categorie_id }}</p> --}}
							<a href="{{ 'offre' . '/' .  $offre->id }}"><h4>{{ $offre->poste }}</h4></a>
							<p class="offres_description"><a href="{{'offre' . '/' .  $offre->id }}">{{substr($offre->description, 0, 400)}}...</a></p>
							<hr>
						</div>
						<br>
					@endforeach
					
					<div id="paginate" class="row text-center">
		            	<p>{{ $offres->links() }}</p>
		        	</div>
		</div>
	</div>

@stop