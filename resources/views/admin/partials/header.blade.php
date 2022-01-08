<nav class="navbar header navbar-expand-lg navbar-light bg-light">
	@if(in_array($layout, ['story']))
		<span class="back">
			<!-- <a class="link" href="{{ $baseUrl }}/admin"> -->
			<a class="link" href="{{ URL::previous() }}">
				<ion-icon name="arrow-round-back"></ion-icon>
			</a>
		</span>
	@elseif(in_array($layout, ['gallery']))
		<img id="logo" src="{{ Config::get('custom.project_url') }}resources/assets/img/logo_white.png" />
	@endif
	
	<span id="title" class="title"> {!! $title !!} </span>
	
	@if(in_array($layout, ['gallery']))
		<div id="logout">
			{{-- <a class="link" href="logout"> --}}
				<a class="link" href="{{route('admin.logout')}}">
				<ion-icon class="logout" name="close"></ion-icon>
			</a>
		</div>
	@endif

	<a class="col-md-offset-2" href="{{route('admin.candidats')}}"><button class="cooptation">COOPTATION</button></a>
	<a class="col-md-offset-1" href="{{route('admin.jobs')}}"><button class="cooptation">OFFRES</button></a>
</nav>



@if(in_array($layout, ['gallery']))

	{{ Form::open(array('route' => ['admin/gallery'], 'name' => 'filter', 'method' => 'GET')) }}
		<!-- { csrf_field() } -->
		<div class="filters" style="position: fixed;width: 100%;background-color: #C10927;z-index: 9999;height: 60px;border-bottom: 1px solid black;">
			<div class="container" style="height:100%;line-height: 60px;font-size: 2vh;">
				<div class="row" style="display: flex;align-items: center;height: 100%;padding: 0.5em 0;position: relative;">
					{!! Form::select('region', $regions, $filters['region'], ['class' => 'form-control']) !!}
					{!! Form::select('responsible', $responsibles, $filters['responsible'], ['class' => 'form-control']) !!}
					<!-- {{ Form::input('password', 'password', '', ['class' => 'formInput', 'placeholder' => ucfirst(Lang::get('admin.password'))]) }} -->
					@if($filters['isTop30'])
						{{ Form::button(strtoupper(Lang::get('admin.top-30')), ['id' => 'top30', 'class' => 'top30 form-control active']) }} 
					@else
						{{ Form::button(strtoupper(Lang::get('admin.top-30')), ['id' => 'top30', 'class' => 'top30 form-control']) }} 
					@endif
					<input type="checkbox" id="isTop30" name="isTop30" <?php if($filters['isTop30']){ echo "checked"; } ?> style="display:none;" />
					
					{{ Form::submit(strtoupper(Lang::get('admin.filter')), ['class' => 'filter form-control']) }} 
					{{ $stories->links() }}
				</div>	
			</div>
		</div>
	{{ Form::close() }}	


@endif



	

