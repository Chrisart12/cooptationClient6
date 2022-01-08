
<nav class="navbar header navbar-expand-lg navbar-light bg-light">
	@if(in_array($layout, ['story']))
		<span class="back">
			<a class="link" href="{{ $baseUrl }}/{{ $from }}">
				<ion-icon name="arrow-round-back"></ion-icon>
			</a>
		</span>
	@elseif(in_array($layout, ['cgu', 'mystory']))
		<span class="back">
			<a class="link" href="{{ $baseUrl }}/gallery">
				<ion-icon name="arrow-round-back"></ion-icon>
			</a>
		</span>
	@elseif(in_array($layout, ['mystoryresize']))
		<span class="back">
			<a class="link" href="{{ $baseUrl }}/mystory">
				<ion-icon name="arrow-round-back"></ion-icon>
			</a>
		</span>
	@elseif(in_array($layout, ['mystorycontent']))
		<span class="back">
			<a class="link" href="{{ $baseUrl }}/mystory">
				<ion-icon name="arrow-round-back"></ion-icon>
			</a>
		</span>
	@elseif(in_array($layout, ['mystoryvalidation']))
		<span class="back">
			<a class="link" href="{{ $baseUrl }}/mystorycontent">
				<ion-icon name="arrow-round-back"></ion-icon>
			</a>
		</span>
	@elseif(in_array($layout, ['gallery']))
		<span id="openSearch" onClick="return true">
			<ion-icon name="search"></ion-icon>
		</span>
		<div id="searchArea">
			<span id="search">
				<ion-icon name="search"></ion-icon>
			</span>
			{{ Form::open(array('route' => ['gallery'], 'name' => 'searchContributor')) }}
				{{ csrf_field() }} 
				<input autofocus id="searchInput" name="searchInput" type="text" value="<?php if(isset($search)){ echo $search; } ?>" placeholder="{{ ucfirst(Lang::get('label.search-contributor')) }}" />
			{{ Form::close() }}
			<span id="closeSearch" onClick="return true">
				<ion-icon name="close"></ion-icon>
			</span>
		</div>
	@endif
	
	<span id="title" class="title"> {!! $title !!} </span>
	
	@if(in_array($layout, ['gallery', 'favorite', 'mystorydone']))
		{{-- <span id="cgu" class="cgu">
			<a class="link" href="cgu">
				<ion-icon name="information-circle"></ion-icon>
			</a>
		</span>
 --}}
		<span id="header-btn-menu" class="cgu header-btn-menu">
			{{-- <a class="link" href="{{ url('menu') }}"> --}}
				<ion-icon class="link" name="menu"></ion-icon>
			{{-- </a> --}}
		</span>
	@endif
	@if(in_array($layout, ['mystory', 'mystorydone', 'mystoryresize', 'mystorycontent']))
		<span class="confirm">
			<a class="link" href="#">
				<ion-icon name="checkmark"></ion-icon>
			</a>
		</span>
	@endif
</nav>