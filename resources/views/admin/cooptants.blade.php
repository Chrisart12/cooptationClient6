@extends('admin.layout.cooptationlayout')
@section('content')
	
<?php 

	$baseUrl = App::make('url')->to('/');
	$title = 'COOPTATION';
?>

<div class=" pages">
	<table class="container">
		<div class="bouton">
			<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
			<a href="{{ route('admin.cooptants') }}"><button class="voir">COOPTANTS</button></a>
		</div>
		<div class="listeCooptation row ">
			<tr>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">COLLABORATEURS</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">NOMBRE DE CANDIDATS</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">TOTAL DES POINTS</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation"></th>
			</tr>
		</div>

		@foreach( $cooptants as  $cooptant)
			<tr>
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{ strtoupper($cooptant->lastname) . ' ' . ucfirst($cooptant->firstname) }} </td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{ $cooptant->cooptes }}</td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{  $cooptant->score }} </td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants"><a href="{{'cooptant' . '/' . $cooptant->user_id }}"><button class="col-lg-offset-4 voir">VOIR</button></a></td>
			</tr>	
		@endforeach
	</table>
</div>

@stop