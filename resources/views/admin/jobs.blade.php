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
		<h2 class="text-center listeCooptation">LES OFFRES</h2>
		<div class="pages text_admin col-md-offset-1 col-md-10 " >
            <div class="jobs-list_label">
                <div>TITRE DU POSTE</div>
                <div>MAGASINS</div>
            </div>
            <div >
                @foreach($jobs as $job)
                <div class="jobs-list_flex">
                        <a class="jobs-list_flex_link" href="{{ 'job/' . $job->id }}">
                            <div class="jobs-title-location">{{ $job->title }}</div>
                        </a>
                        <div class="jobs-title-location">{{ $job->location }}</div>
                </div>
                <br>
                
                {{-- <p><img src="{{  $job->logoURL }}" alt=""> </p>
                <p><img src="{{  $job->imageURL }}" alt=""> </p> --}}
                {{-- <p><a href="{{  $job->vacancyURL }}">job</a></p>
                <p><a href="{{  $job->ApplicationURLL }}">Application</a></p> --}}
                {{-- <p>{{  $job->departementId }}</p>
                <p>{{  $job->categories[0]}}</p> --}}
                
                @endforeach
            </div>
        
					
		</div>
	</div>

@stop