<?php

namespace App\Http\Controllers;

use Auth;
use Datetime;
use Lang;
use Redirect;

use App\Story;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
	// Show myfavorite page
	public function showMyFavoritePage(){
		// si l'utilisateur est authentifié
		if(Auth::check()){
			// on récupère la liste des stories favorites
			$stories = Story::getFavorites(Auth::user()->id);
			
			// dd($stories);
			
			return view('favorite', ['stories' => $stories]);
		} else{
			// return Redirect::route("showLogin")->withErrors(Lang::get('label.must-be-logged'));
			return Redirect::route("login")->with('message', ucfirst(Lang::get('label.please-login')));
		}
	}
}