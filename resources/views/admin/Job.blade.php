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
		
		<div class="pages text_admin col-md-offset-1 col-md-10 " >
            <div class="jobs-list_label">
                <div>TITRE DU POSTE</div>
                <div>MAGASINS</div>
            </div>
            <div >
                @foreach($jobIds as $jobId)
                <div>
                    <h2 class="text-center listeCooptation">{{ $jobId->title }}</h2>
                    <div class="jobs-title-location">{{ $jobId->id }}</div>
                    <div class="jobs-title-location">{{ $jobId->date_start }}</div>
                    <div class="jobs-title-location">{{ $jobId->date_end }}</div>
                    <div class="jobs-title-location">{{ $jobId->reference_number }}</div>
                    <div class="jobs-title-location">{{ $jobId->location }}</div>
                    <div class="jobs-title-location">{!! $jobId->description !!}</div>
                    <div class="jobs-title-location">{{ $jobId->county }}</div>
                    <div class="jobs-title-location">{{ $jobId->departement }}</div>
                    <div class="jobs-title-location">{{ $jobId->logoURL }}</div>
                    <div class="jobs-title-location">{{ $jobId->vacancyURL }}</div>
                    <div> <img src=" {{ $jobId->imageURL }}" alt="lll"></div>
                    
                </div>
                
            
                @endforeach
            </div>
        
					
		</div>
	</div>

@stop