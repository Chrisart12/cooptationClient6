@extends('admin.layout.loginlayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row login">
	<div class="col-xs-12 content">
		<div class="row">
			<div class="col-xs-12"> 
				{{ Form::open(array('route' => ['admin/login'])) }}
					{{ csrf_field() }} 
					
					<div class="row">
						<div class="col-xs-12"> 
							<h2>{{ mb_strtoupper(Lang::get('admin.mastory')) }}</h2>
						</div>
						<div class="col-xs-12"> 
							<h3>{{ ucfirst(Lang::get('admin.administration')) }}</h3>
						</div>
					</div>
					
					<hr class="noBorder" />
					
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::input('text', 'token', '', ['class' => 'formInput', 'placeholder' => ucfirst(Lang::get('label.login'))]) }}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::input('password', 'password', '', ['class' => 'formInput', 'placeholder' => ucfirst(Lang::get('label.password'))]) }} 
						</div>
					</div>
					
					<hr class="noBorder" />
					
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::submit(strtoupper(Lang::get('label.signin')), ['class' => 'button']) }} 
						</div>
					</div>
				{{ Form::close() }}
					
				<hr class="noBorder" />
				
				<!--
				<div style="position:fixed; bottom:2vh; left:0; width:100%;"> 
					<span class="title"> 
						{!! ucfirst(Lang::get('label.good-story-to-tell')) !!} 
					</span>
				</div>
				-->
					
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

@stop