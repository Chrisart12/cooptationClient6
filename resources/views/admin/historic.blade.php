@extends('admin.layout.gallerylayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class=" pages">
	<table class="container">

		<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>

		<div class="listeCooptation row ">
			<tr>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">ADMINISTRATEURS</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">CANDIDATS</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">ETAPES</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">DATE</th>
			</tr>
		</div>

		@foreach( $historics as $historic)
			<tr>
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{ strtoupper($historic->admin_lastname) . ' ' .  $historic->admin_firstname}} </td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{ strtoupper($historic->lastname) . ' ' . $historic->firstname }}</td>
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{  $historic->label }}</td>		
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{  $historic->created_at }} </td>	
			</tr>
		@endforeach
	</table>
		<div id="paginate" class="row text-center">
			<p>{{ $historics->links() }}</p>
		</div>	
</div>

@stop