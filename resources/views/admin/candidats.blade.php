@extends('admin.layout.cooptationlayout')
@section('content')
	
<?php 

	$baseUrl = App::make('url')->to('/');
	$title = 'CANDIDATS';
?>

	<div class=" pages">
	<table class="container">
        <div class="bouton">
			<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
			<a href="{{ route('admin.cooptants') }}"><button class="voir">COOPTANTS</button></a>
	   </div>

		<div class="listeCooptation row ">
			<tr>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">CANDIDATS</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">POSTE</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">DATE DE CANDIDATURE</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation"></th>
			</tr>
		</div>

		@foreach( $candidats as $candidat)
			<tr>
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{ strtoupper($candidat->lastname) . ' ' . ucfirst($candidat->firstname) }} </td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{ $candidat->poste }}</td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{date('d-m-Y à H:i:s', strtotime( $candidat->created_at ))}} </td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants"><a href="{{'cooptant/candidat' . '/' . $candidat->id }}"><button class="col-lg-offset-4 voir">DETAIL</button></a></td>
			</tr>	
		@endforeach
	</table>

	<div id="paginate" class="row text-center">
		<p>{{ $candidats->links() }}</p>
	</div>	
</div>
@stop