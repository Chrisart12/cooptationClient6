@extends('layout.signuplayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row signup" style="display:none;">
	<div class="col-xs-12 content">
		<div class="row">
			<div class="col-xs-12"> 
				{{ Form::open(array('route' => ['signup'])) }}
					<div class="row">
						<div class="col-xs-12"> 
							<h2 class="title"> {{ ucfirst(Lang::get('label.password-creation')) }} </h2>
						</div>
					</div>
					
					<hr class="noBorder" />
					
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::input('text', 'collaboratorToken', '', ['class' => 'formInput', 'placeholder' => ucfirst(Lang::get('label.collaborator-token'))]) }}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::input('password', 'password', '', ['class' => 'formInput', 'placeholder' => ucfirst(Lang::get('label.password'))]) }} 
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::input('password', 'passwordVerif', '', ['class' => 'formInput', 'placeholder' => ucfirst(Lang::get('label.password-verif'))]) }} 
						</div>
					</div>
					
					<hr class="noBorder" />

					<!-- <div class="row">
						<div class="col-xs-12" style="color:#FFFFFF;">
							{{ ucfirst(Lang::get('label.i-red')) }} 
							{{ Html::link(url('login'), ucfirst(Lang::get('label.cgu')), array('class' => 'link'), true) }}
							<a href="#" id="cgu" class="link" > {{ ucfirst(Lang::get('label.cgu')) }} </a>
						</div>
					</div> -->
					
					<hr class="noBorder" />
					
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::submit(strtoupper(Lang::get('label.signup')), ['class' => 'button signUpButton']) }} 
						</div>
					</div>
					
					<hr class="noBorder" />

					<div class="row">
						<div class="col-xs-12">
							{{ Html::link(url('login'), ucfirst(Lang::get('label.signin')), array('class' => 'link'), true) }}
						</div>
					</div>
				{{ Form::close() }}
					
				<hr class="noBorder" />
					
				@if($errors->any())
					<div class="alert alert-danger" role="alert">
						@foreach($errors->all() as $error)
							{{ $error }}
						@endforeach
					</div>
				@endif
				@if(Session::has('message'))
					<div class="alert alert-info">
						{{ Session::get('message') }}
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<div>
	@include('partials.cgucreation')
</div>
				
<div class="shareOurStories">
	{{ ucfirst(Lang::get('label.share-our-stories')) }}
</div>

<script>
	// $(document).on('click', '#cgu', function(){
		// $('.signUpButton').show();
		// $('.row.cgu').show();
		// $('.row.signup').hide();
	// });
	$(document).on('click', '#ired', function(){
		$('.signUpButton').show();
		$('.row.cgu').hide();
		$('.row.signup').show();
	});
</script>

@stop