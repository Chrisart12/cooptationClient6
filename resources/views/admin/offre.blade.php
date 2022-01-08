@extends('admin.layout.cooptationlayout')

@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		$title = 'OFFRE';
	?>

	<div class=" pages">
		<table class="container">
			<div class="bouton">
				<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
				<a href="{{route('admin.offres.create')}}"><button class="voir">PUBLIER</button></a>
			</div>
			<div class="listeCooptation col-md-offset-1 col-md-10 liste_offre_admin">
				@foreach($offres as $offre)
					<h2 class="">{{ $offre->poste }}</h2>
			
						<div>
							<p>{{ $offre->lieu }}</p>
							<p>Réf : {{ $offre->reference }}</p>
							<p>Catégorie : {{ $offre->label }}</p>
							<p>{{ $offre->description }}</p>
						</div>
						<div class="row edit_delete">
							<a href="{{ $offre->id . '/' . 'edit' }}"><button class="cooptation">MODIFIER</button></a>
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.offres.destroy', $offre->id]]) !!}
							{!! Form::submit('SUPPRIMER', ['class' => 'cooptation', 'onclick' => 'return confirm(\'Vraiment supprimer cette annonce ?\')']) !!}
							{!! Form::close() !!}
						</div>
					@endforeach
			</div>

			
			
	</div>


@stop