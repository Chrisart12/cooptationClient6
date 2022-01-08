<nav class="navbar header navbar-expand-lg navbar-light bg-light navbar-offres">
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
	@elseif(in_array($layout, ['gallery','favorite', 'mystorydone']))
        <span id="cgu" class="cgu">
            <a class="arrow-round-back" href="javascript:history.back()">
                <ion-icon name="arrow-round-back"></ion-icon>

            </a>
        </span>
	@endif
	
	<span id="title" class="title"> {!! $title !!} </span>
	
	@if(in_array($layout, ['gallery', 'favorite', 'mystorydone']))
		{{-- <span id="cgu" class="cgu">
			<a class="link" href="cgu">
				<ion-icon name="information-circle"></ion-icon>
			</a>
		</span> --}}

		<span id="cgu" class="cgu">
			<a class="link" href="{{ url('menu') }}">
				<ion-icon name="menu"></ion-icon>
			</a>
		</span>
	@endif
	@if(in_array($layout, ['mystory', 'mystorydone', 'mystoryresize', 'mystorycontent']))
		<span class="confirm">
			<a class="link" href="#">
				<ion-icon name="checkmark"></ion-icon>
			</a>
		</span>
    @endif
    
    {{-- Barre de recherche des offres --}}
    
	<form method="POST" action="{{ url('offres') }}" >
		{{ csrf_field() }}
		<div class="form-fixed-back">
		<div class="form-fixed">
			<div class="form-group form-search">
                <div class="input-flex">
                    <input type="search" class="form-control border-input" name="query" placeholder="Rechercher une offre">
                </div>
                <div class="buton-flex">
                    <button type="submit" class="btn btn-default border-input"><ion-icon name="search" ></ion-icon></button>
                </div>
			</div>
		</div>
		</div>
    </form>
   
	{{-- Fin de barre de recherche des offres --}}
</nav>