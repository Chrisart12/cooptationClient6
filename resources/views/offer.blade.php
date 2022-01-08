@extends('layout.gallerylayout')

@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		
	?>
	<div class="scrollable pages_user_cooptation">
		<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
	<div class="row text-center" id="menu">
			<p class="texte">Vous êtes sur le point de proposer un postulant pour le poste de : <a href="{{ url('offre' . '/' .  $offre->id )}}">{{strtolower($offre->poste) }}</a>.</p>
			<p class="texte">Veuillez renseigner les coordonées du candidat et cliquer sur envoyer.</p>

			<div  class="col-xs-offset-2 col-xs-8 formOffer">
				{{-- ['route' => ['admin.offres.update', $offre->id] --}}
				{!! Form::open(['route' => ['offer', $offre->id] ]) !!}
						<div class="form-group {!! $errors->has('lastName') ? 'has-error' : '' !!}">
							{{ Form::text('lastName', null, ['class' => 'form-control', 'placeholder' => 'Nom*']) }}
							{!! $errors->first('lastName', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('firstName') ? 'has-error' : '' !!}">
							{{ Form::text('firstName', null, ['class' => 'form-control', 'placeholder' => 'Prénom*']) }}
							{!! $errors->first('firstName', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('reference') ? 'has-error' : '' !!}">
							{{ Form::text('reference', 'Réf : ' . $offre->reference, ['class' => 'form-control', 'readonly']) }}
							{!! $errors->first('reference', '<small class="help-block">:message</small>') !!}
						</div>
					
						{!! Form::submit('ENVOYER', ['class' => 'btn btn-default btn-block envoyer']) !!}
					{!! Form::close() !!}
			</div>
			
	</div>
	</div>

@stop