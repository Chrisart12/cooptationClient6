@extends('admin.layout.cooptationlayout')
@section('content')
	
<?php 

	$baseUrl = App::make('url')->to('/');
	$title = 'CANDIDAT';
?>

	<div class="container pages ">

		<a href="javascript:history.back()"><button class="voir"><img src="{{ asset('public/icons/back1.png') }}">RETOUR</button></a>

		<div class="alignement listeCooptation">
			 <div>
			 	<div><span class="designation">CANDIDAT</span></div>
				<br>
				<br>
				<div>
					<p class="cooptants">{{ strtoupper($candidat->lastname) . ' ' . ucfirst($candidat->firstname) }}</p>
					<p class="cooptants">Poste : {{ $candidat->poste }} </p>
					<p class="cooptants">Date de candidature : {{ date('d-m-Y', strtotime( $candidat->created_at)) }} </p>
				</div>
				<br>
				<br>
			</div>
			<div>
				<div ><span class="designation ">ETAPES</span></div>
				<br>
				<br>
				@if($candidat->is_done == 1)
						
					@foreach($ordres as $ordre)
							<div>
								<button type="submit" class="text-center boutons fin-etape" disabled="disabled" >{{ $ordre->label }}</button>
							</div>
					@endforeach
					
				@else
						@foreach($ordres as $ordre)
				
							<form method="POST" action="{{ 'etapes' }}" data-remote data-remote-success-message="L'étape{{ $candidat->label }}est passée.">
								{{ csrf_field() }}

								<input type="hidden" name="categorie_id" id="categorie_id" value="{{ $candidat->categorie_id }}">
								<input type="hidden" name="id" id="firstRdv" value="{{ $candidat->candidat_id }}">
								
							
								@if($ordre->step_id != $step->step_id)

									@if($ordre->ordre < $step->ordre)
										<button type="submit" class="fin-etape text-center boutons color-etape" data-background-color="#69f0ae" data-tex-color="blue" disabled="disabled">
											{{ $ordre->label }}
										</button>
									@else
										<button type="submit" class="etapes text-center boutons" data-background-color="#69f0ae" data-tex-color="blue" disabled="disabled" >
											{{ $ordre->label }}
										</button>
									@endif
								@else
									<button type="submit"  class="etapes text-center boutons">{{ $ordre->label }}</button>
								@endif
							</form> 
						@endforeach
				@endif
				
			</div>

			<div>
				<div><span class="designation">DATES</span></div>
				<br>
				<br>

				{{-- <div>
					<p class=" date ">{{ date('d-m-Y', strtotime( $candidat->created_at )) }}</p>
				</div> --}}
				@foreach($stepCandidats as $stepCandidat)
					<div>
						<p class="date">{{ date('d-m-Y H:i:s', strtotime( $stepCandidat->created_at )) }}</p>
					</div>
				@endforeach
			</div>
		</div>
	</div>

@stop