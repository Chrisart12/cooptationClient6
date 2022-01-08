@extends('admin.layout.cooptationlayout')
@section('content')
	
<?php 

	$baseUrl = App::make('url')->to('/');
	$title = 'COOPTANTS';
?>

<div class=" pages">
	<table class="container">

		<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>
		<br>
		<br>
         
        <div class="text-center designation">{{ strtoupper($cooptant->lastname). ' ' . $cooptant->firstname }}</div>

		<div class="listeCooptation row ">
			<tr>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">CANDIDATS</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">REFERENCE</th>
				<th class="col-lg-3 col-sm-3 col-xs-3 designation">POINTS</th>
			</tr>
		</div>

		@foreach($userCooptes as $userCoopte)
			<tr>
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{ strtoupper($userCoopte->lastname) . ' ' . $userCoopte->firstname }} </td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{ $userCoopte->reference }}</td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants">{{ $userCoopte->score}} </td>	
				<td class="col-lg-3 col-sm-3 col-xs-3 cooptants"> <a href="{{'candidat' . '/' . $userCoopte->candidat_id }}"><button class="col-lg-offset-4 voir">DETAIL</button></a></td>
			</tr>	
		@endforeach
	</table>
</div>


@stop