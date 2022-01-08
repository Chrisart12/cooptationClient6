@extends('layout.loginlayout')

@section('content')

<?php 

	$baseUrl = App::make('url')->to('/');
	
?>

<div class="row login">
	<div class="col-xs-12 content">
		<div class="row">
			<div class="col-xs-12"> 
				{{ Form::open(array('route' => ['login'])) }}
					{{ csrf_field() }} 
					<div class="row">
						<div class="col-xs-12"> 
							<h2 class="logo"> 
								<img id="logo" src="{{ Config::get('custom.project_url') }}resources/assets/img/logo_color.png" />
							</h2>
						</div>
					</div>
					
					<hr class="noBorder" />
					
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::input('text', 'token', '', ['class' => 'formInput', 'placeholder' => ucfirst(Lang::get('label.collaborator-token'))]) }}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::input('password', 'password', '', ['class' => 'formInput', 'placeholder' => ucfirst(Lang::get('label.password'))]) }} 
						</div>
					</div>
					
					<hr class="noBorder" />
					
					<!-- <div class="row">
						<div class="col-xs-12"> 
							<span class="title"> 
								{!! ucfirst(Lang::get('label.good-story-to-tell')) !!} 
							</span>
						</div>
					</div> -->
					
					<hr class="noBorder" />
					
					<div class="row">
						<div class="col-xs-12"> 
							{{ Form::submit(strtoupper(Lang::get('label.signin')), ['class' => 'button']) }} 
						</div>
					</div>
				{{ Form::close() }}
					
				<hr class="noBorder" />
				
				
				<div class="row">
					<div class="col-xs-12"> 	
						{{ Html::link(url('/signup'), ucfirst(Lang::get('label.create-password')), array('class' => 'link'), true)}}
					</div>
					<!-- <div class="col-xs-12">
						{{ ucfirst(Lang::get('label.alreadyAccount'))." ?" }}
					</div> -->
				</div>
					
				<hr class="noBorder" />
				
		
				<div style="position:fixed; bottom:2vh; left:0; width:100%;"> 
					<span class="title"> 
						{!! ucfirst(Lang::get('label.good-story-to-tell')) !!} 
					</span>
				</div>
					
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

<div  id="pwaPopupSamsungChrome" style="display:none;">
	<div class="wrap" style="position:fixed;display:flex;align-items:center;justify-content:center;width:100%;height:100%;top:0;left:0;background-color:rgba(0,0,0,0.5);">
		<div class="body" style="width:80vw;background-color:#FFFFFF;color:#000000;">
			<div class="instructions" style="padding:4vh;">
				<div class="text" style="margin:0vh 0 0vh;font-size:2vh;">
					<div>
						Pour enregistrer Ma Story sur votre smartphone, suivez les étapes suivantes: 
					</div>
					<div style="display: flex;align-items: center;justify-content: left;">
						<div> 1. Cliquez sur </div>
						<div style="display:flex;">
							<!-- <span> <img id="pwaAddMenu1" style="height: 5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/chrome/pwa-add-1.png" /> </span> -->
							<div style="padding-left:5px;color:#C10927;display: flex;align-items: center;justify-content: center;font-size:4vh;"> <ion-icon name="menu"></ion-icon> </div>
						</div>
					</div>
					<div>
						<!-- 2. Télécharger l’application en cliquant sur : <br />
						<div style="display:flex;flex-direction:column;align-items: center;justify-content: center;color:#C10927;font-weight:bold;"> 
							<div style="font-size:3vh;"> <ion-icon name="add"></ion-icon> </div> 
							<div> Ajouter la page à </div> 
						</div> -->
						2. Télécharger l’application en cliquant sur :  <b> <span style="color:#C10927;"> + </span><span style="color:#C10927;"> Ajouter la page à </span> </b>
					</div>
					<div>
						3. Puis sur : <span style="color:#C10927;font-weight:bold;">Ecran Applis </span>
					</div>
				</div>
			</div>
			<div class="toWeb" style="padding:2vh;font-size:2vh;text-align:center;border-top:1px solid black;color:#C10927" onClick="$('#pwaPopupSamsungChrome').hide()">
				<b> CONTINUER VERS LE SITE WEB </b>
			</div>
		</div>
	</div>
</div>

<div  id="pwaPopupChrome" style="display:none;">
	<div class="wrap" style="position:fixed;display:flex;align-items:center;justify-content:center;width:100%;height:100%;top:0;left:0;background-color:rgba(0,0,0,0.5);">
		<div class="body" style="width:80vw;background-color:#FFFFFF;color:#000000;">
			<div class="instructions" style="padding:4vh;">
				<div class="text" style="margin:0vh 0 0vh;font-size:2vh;">
					<div>
						Pour enregistrer Ma Story sur votre smartphone, suivez les étapes suivantes: 
					</div>
					<div style="display: flex;align-items: center;justify-content: left;">
						<div> 1. Cliquez sur </div>
						<div>
							<span> <img id="pwaAddMenu1" style="height: 5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/chrome/pwa-add-1.png" /> </span>
						</div>
					</div>
					<div>
						2. Télécharger l’application en cliquant sur « <span style="color:#C10927;font-weight:bold;"> Ajouter à l'écran d'accueil </span> »
					</div>
				</div>
				<!-- <div class="draw">
					<div class="border" style="display:flex;border:2px solid black;padding: 5px;font-size:4vh;">
						<div style="flex-grow:1;display:flex;align-items: center;"> <ion-icon name="lock"></ion-icon> </div>
						<div style="display:flex;align-items: center;_color:#C10927"> <ion-icon name="square-outline"></ion-icon> </div>
						<div style="display:flex;align-items: center;"> 
							<img id="pwaAddMenu1" style="height: 5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/chrome/pwa-add-1.png" />
						</div>
					</div>
					<div style="display:flex;align-items:center;justify-content:center;font-size:4vh;margin:2vh 0;">
						<ion-icon name="arrow-round-down"></ion-icon>
					</div>
					<div style="display:flex;align-items:center;justify-content:center;color:#C10927;font-weight:bold;font-size:2vh;">
						<span> Ajouter à l'écran d'accueil </span>
					</div>
				</div>
				<div class="text" style="margin:4vh 0 2vh;font-size:2vh;">
					Vous pouvez facilement ajouter ce site à votre écran d'accueil 
					pour y avoir accès directement et naviguer plus rapidement, 
					comme si vous étiez dans l'application
				</div> -->
			</div>
			<div class="toWeb" style="padding:2vh;font-size:2vh;text-align:center;border-top:1px solid black;color:#C10927" onClick="$('#pwaPopupChrome').hide()">
				<b> CONTINUER VERS LE SITE WEB </b>
			</div>
		</div>
	</div>
</div>

<div  id="pwaPopupSafari" style="display:none;">
	<div class="wrap" style="position:fixed;display:flex;align-items:center;justify-content:center;width:100%;height:100%;top:0;left:0;background-color:rgba(0,0,0,0.5);">
		<div class="body" style="width:80vw;background-color:#FFFFFF;color:#000000;">
			<div class="instructions" style="padding:4vh;">
				<div class="text" style="margin:0vh 0 0vh;font-size:2vh;">
					<div>
						Pour enregistrer Ma Story sur votre smartphone, suivez les étapes suivantes: 
					</div>
					<div style="display: flex;align-items: center;justify-content: left;">
						<div style="margin-right:1vh;"> 
							1. Cliquez sur 
						</div>
						<div style="display:flex;align-items: center;justify-content: flex-end;color:#C10927;">
							<img id="pwaAddMenu1" style="height: 5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/ios/pwa-add-1.png" />
						</div>
					</div>
					<div style="display: flex;align-items: center;justify-content: left;">
						<div> 
							2. Télécharger l’application en cliquant sur  
							<img id="pwaAddMenu1" style="height: 5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/ios/pwa-add-2.png" />
						</div>
					</div>
				</div>
				<!-- <div class="draw">
					<div class="border" style="display:flex;padding: 5px;font-size:4vh;">
						<div style="flex-grow:1;display:flex;align-items: center;justify-content: flex-end;color:#C10927;">
							<img id="pwaAddMenu1" style="height: 5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/ios/pwa-add-1.png" />
						</div>
						<div style="flex-grow:1;display:flex;align-items: center;justify-content: center;"> <ion-icon name="arrow-round-forward"></ion-icon> </div>
						<div style="flex-grow:1;display:flex;align-items: center;justify-content: flex-start;color:#C10927;"> 
							<img id="pwaAddMenu1" style="height: 5vh;" src="{{ Config::get('custom.project_url') }}resources/assets/img/ios/pwa-add-2.png" />
						</div>
					</div>
				</div>
				<div class="text" style="margin:4vh 0 2vh;font-size:2vh;">
					Vous pouvez facilement ajouter ce site à votre écran d'accueil 
					pour y avoir accès directement et naviguer plus rapidement, 
					comme si vous étiez dans l'application
				</div> -->
			</div>
			<div class="toWeb" style="padding:2vh;font-size:2vh;text-align:center;border-top:1px solid black;color:#C10927" onClick="$('#pwaPopupSafari').hide()">
				<b> CONTINUER VERS LE SITE WEB </b>
			</div>
		</div>
	</div>
</div>

<div  id="pwaPopupFirefox" style="display:none;">
	<div class="wrap" style="position:fixed;display:flex;align-items:center;justify-content:center;width:100%;height:100%;top:0;left:0;background-color:rgba(0,0,0,0.5);">
		<div class="body" style="width:80vw;background-color:#FFFFFF;color:#000000;">
			<div class="instructions" style="padding:4vh;">
				<div class="text" style="margin:0vh 0 0vh;font-size:2vh;">
					<div>
						Pour enregistrer Ma Story sur votre smartphone, suivez les étapes suivantes: 
					</div>
					<div style="display: flex;align-items: center;justify-content: left;">
						<div style="margin-right:1vh;"> 1. Cliquez sur </div>
						<div>
							<span style="font-size:4vh;color:#C10927;"> <ion-icon name="home"></ion-icon> </span>
						</div>
					</div>
					<div>
						2. Télécharger l’application en cliquant sur « <span style="color:#C10927;font-weight:bold;"> Ajouter à l'écran d'accueil </span> »
					</div>
				</div>
				<!-- <div class="draw">
					<div class="border" style="display:flex;border:2px solid black;padding: 5px;font-size:4vh;">
						<div style="flex-grow:1;display:flex;align-items: center;"> <ion-icon name="lock"></ion-icon> </div>
						<div style="display:flex;align-items: center;color:#C10927"> <ion-icon name="home"></ion-icon> </div>
					</div>
				</div>
				<div class="text" style="margin:4vh 0 2vh;font-size:2vh;">
					Vous pouvez facilement ajouter ce site à votre écran d'accueil 
					pour y avoir accès directement et naviguer plus rapidement, 
					comme si vous étiez dans l'application
				</div> -->
			</div>
			<div class="toWeb" style="padding:2vh;font-size:2vh;text-align:center;border-top:1px solid black;color:#C10927" onClick="$('#pwaPopupFirefox').hide()">
				<b> CONTINUER VERS LE SITE WEB </b>
			</div>
		</div>
	</div>
</div>

<script>
	
	$(document).ready(function(){
		/** check for mobile/tablet **/
		window.mobileAndTabletcheck = function() {
			var check = false;
			(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
			return check;
		};
		
		/** check for browser user agent **/
		// Opera 8.0+
		// var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
		// Firefox 1.0+
		var isFirefox = typeof InstallTrigger !== 'undefined';
		// Safari 3.0+ "[object HTMLElementConstructor]" 
		// var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
		var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
		// Internet Explorer 6-11
		// var isIE = /*@cc_on!@*/false || !!document.documentMode;
		// Edge 20+
		// var isEdge = !isIE && !!window.StyleMedia;
		// Chrome 1 - 71
		// var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
		var isChrome = false;
		var ua = navigator.userAgent;
		if (/Chrome/i.test(ua)){
			isChrome = true;
		}
		
		// 
		var isSamsungBrowser1 = navigator.userAgent.match(/SamsungBrowser/i) != null;
		// alert("isSamsungBrowser1 : " + isSamsungBrowser1);
		
		var isSamsungBrowser2 = navigator.userAgent.match(/SAMSUNG|Samsung|SGH-[I|N|T]|GT-[I|N]|SM-[A|N|P|T|Z]|SHV-E|SCH-[I|J|R|S]|SPH-L/i) != null;
		// alert("isSamsungBrowser2 : " + isSamsungBrowser2);
		
		// Blink engine detection
		// var isBlink = (isChrome || isOpera) && !!window.CSS;
		
		if(window.mobileAndTabletcheck()){ 
			var check = checkCookie();
			
			if(!check && isChrome){
				// samsung chrome
				if(isSamsungBrowser1 || isSamsungBrowser2){
					$("#pwaPopupSamsungChrome").show();
				
				// others
				} else{
					$("#pwaPopupChrome").show();
				}
			}
			if(!check && isFirefox){
				$("#pwaPopupFirefox").show();
			}
			if(!check && isSafari){
				$("#pwaPopupSafari").show();
			}
		}
	});
	
</script>

<script>

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	function checkCookie() {
		var pwaPopupSeen = getCookie("pwa-pop-seen");
		if (pwaPopupSeen != "") { 
			// alert("Popup already seen");
			// console.log("pop up already seen");
			return true;
		} else {
			// username = prompt("Please enter your name:", "");
			// alert("Popup");
			pwaPopupSeen = true;
			if (pwaPopupSeen != "" && pwaPopupSeen != null) {
				setCookie("pwa-pop-seen", pwaPopupSeen, 365);
			}
			return false;
		}
	}

	
</script>

@stop