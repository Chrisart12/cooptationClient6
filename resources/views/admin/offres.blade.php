@extends('admin.layout.cooptationlayout')
	{{-- Barre de recherche des offres --}}
	<form method="GET" action="{{ url('admin/offres') }}" class="navbar-form navbar-right formRecherche">
		{{ csrf_field() }}
			<div class="form-group">
				<input type="search" class="form-control" name="query" id="search" placeholder="Rechercher une offre">
			</div>
			<button type="submit" class="btn btn-primary"><ion-icon name="search" id="search"></ion-icon></button>
	</form>
	{{-- Fin de barre de recherche des offres --}}
@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		$title = 'OFFRES';
	?>
	
	<div class=" pages container">
			
			<div class="bouton">
				<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
				<a href="{{route('admin.offres.create')}}"><button class="voir">PUBLIER</button></a>
			</div>
			<div class="listeCooptation liste_offre_admin">
				<h2 class="text-center text_margin_bottom">LES OFFRES D'EMPLOI SUR MaStory</h2>
				@foreach($offres as $offre)
					<div class="col-md-offset-2 col-md-offset-8 liste_offres_admin">
						<p>{{ $offre->lieu }}</p>
						<p>Réf : {{ $offre->reference }}</p>
						<p>Catégorie : {{ $offre->label }}</p>
						<a class="liste_offre_admin titre_offres" href="{{ 'offres' . '/' .  $offre->id }}"><h4 class="">{{ $offre->poste }}</h4></a>
						<p class="description "><a class="liste_offre_admin" href="{{'offres' . '/' .  $offre->id }}">{{substr($offre->description, 0, 500)}}...</a></p>
					</div>
					<hr>
					<br>
					<br>
	
				@endforeach
			</div>
			<div id="paginate" class="row text-center">
				<p>{{ $offres->links() }}</p>
			</div>	
	</div>


@stop