@extends('admin.layout.cooptationlayout')

@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		$title = 'OFFRES';
	?>

	<div class="container pages">
		<div class="buton">
			<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
		</div>
		<h2 class="text-center listeCooptation">Veuillez remplir tous les champs pour publier une offre.</h2>
		<div class="pages text_admin col-md-offset-1 col-md-10 " >

					{!! Form::open(['route' => 'admin.offres.store']) !!}
						<div class="form-group {!! $errors->has('categorie') ? 'has-error' : '' !!}">
							{{ Form::select("categorie_id", ['1' => 'Cadre', '2' => 'Employer'], null, ["class" => 'form-control', 'placeholder' => " Catégorie"]) }}
							{!! $errors->first('categorie_id', '<small class="help-block">:message</small>') !!}
						</div>

						<div class="form-group {!! $errors->has('reference') ? 'has-error' : '' !!}">
							{!! Form::label("reference", "Référence*", ['class' => 'control-label']) !!}
							{{ Form::text('reference', null, ['class' => 'form-control', 'placeholder' => 'Référence']) }}
							{!! $errors->first('reference', '<small class="help-block">:message</small>') !!}
						</div>
						
						<div class="form-group {!! $errors->has('lieu') ? 'has-error' : '' !!}">
							{!! Form::label("lieu", "Lieu*", ['class' => 'control-label']) !!}
							{{ Form::text('lieu', null, ['class' => 'form-control', 'placeholder' => 'Lieu']) }}
							{!! $errors->first('lieu', '<small class="help-block">:message</small>') !!}
						</div>
						
						<div class="form-group {!! $errors->has('poste') ? 'has-error' : '' !!}">
							{!! Form::label("poste", "Poste*", ['class' => 'control-label']) !!}
							{{ Form::text('poste', null, ['class' => 'form-control', 'placeholder' => 'Poste']) }}
							{!! $errors->first('poste', '<small class="help-block">:message</small>') !!}
						</div>
						
						<div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
							{{ Form::textarea ('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) }}
							{!! $errors->first('description', '<small class="help-block">:message</small>') !!}
						</div>
						{!! Form::submit('PUBLIER', ['class' => 'btn btn-default btn-block cooptation']) !!}
					{!! Form::close() !!}
		</div>
	</div>

@stop