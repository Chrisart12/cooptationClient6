<nav class="navbar footer navbar-expand-lg navbar-light bg-light">
	@if(in_array($layout, ['mystory']))
		<!-- <div class="container">
			<div class="row pictures">
				<div class="col-xs-6 picture"> 
					<a class="link" href="{{ $baseUrl }}/gallery">
						{{ strtoupper(Lang::get('label.gallery')) }}
					</a>
				</div>
				<div class="col-xs-6 picture"> 
					<a class="link" href="{{ $baseUrl }}/mystory">
						{{ strtoupper(Lang::get('label.picture')) }}
					</a>
				</div>
			</div>
		</div> -->
		<div class="container">
			<div class="pictures">
				<div class="picture gallery" onClick="function(){ console.log('gallery') }"> 
					{{ strtoupper(Lang::get('label.gallery')) }}
				</div>
				<div class="picture camera" onClick="function(){ console.log('camera') }"> 
					{{ strtoupper(Lang::get('label.picture')) }}
				</div>
			</div>
		</div>
	@elseif(in_array($layout, ['mystoryvalidation']))
		<div class="container">
			<div class="mystory">
				<div class="validation" onClick="return true;"> 
					{{ strtoupper(Lang::get('label.my-story-validation')) }}
				</div>
			</div>
		</div>
	@else
		<div class="container">
			<div class="row menus">
				<div class="col-xs-4 menu <?php if($layout == "gallery"){ echo "active"; } ?>"> 
					<a class="link" href="{{ $baseUrl }}/gallery">
						<ion-icon name="home"></ion-icon>
					</a>
				</div>
				@if(Auth::user()->story->is_done)
					<div class="col-xs-4 menu <?php if($layout == "mystorydone"){ echo "active"; } ?>"> 
						<a class="link" href="{{ $baseUrl }}/mystorydone">
							<ion-icon name="contact"></ion-icon>
						</a>
					</div>
				@else
					<div class="col-xs-4 menu <?php if(in_array($layout, ["mystory", "mystorycontent"])){ echo "active"; } ?>"> 
						<a class="link" href="{{ $baseUrl }}/mystory">
							<ion-icon name="camera"></ion-icon>
						</a>
					</div>
				@endif
				<div class="col-xs-4 menu <?php if($layout == "favorite"){ echo "active"; } ?>"> 
					<a class="link" href="{{ $baseUrl }}/favorite">
						<ion-icon name="heart"></ion-icon>
					</a>
				</div>
			</div>
		</div>
	@endif
</nav>