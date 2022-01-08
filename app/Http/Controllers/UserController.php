<?php

namespace App\Http\Controllers;

use App;
use Auth;
// use DateTime;
// use DateInterval;
// use DB;
use File;
use Hash;
use Lang;
use Form;
use Request;
use Redirect;
use Response;
use Session;
// use URL;
// use Mail;
// use Validator;

use App\User;
use App\Story;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\PasswordController;

use Illuminate\Support\Str;

class UserController extends Controller
{
	/**
	 * Affiche la page de connexion
	 */
	public function showLoginPage()
	{
		// Création rapide d'utilisateur
		// $user = new App\User();
		// $user->password = Hash::make('user');
		// $user->email = 'user@gmail.com';
		// $user->name = 'user';
		// $user->save();
		
		// Session::regenerateToken();
		
		// dd();
		
		// si l'utilisateur n'est pas authentifié, on affiche la page de login
		if(!Auth::check()){
			return view('login');
		// sinon on le redirige vers la homepage
		} else{
			return Redirect::route("gallery");
		}
	}

	/**
	 * Permet de se connecter
	 */
	public function login(\Illuminate\Http\Request $request)
	{
		// $this->validate($request, ['email' => 'required|email']);
		$this->validate($request, ['token' => 'required']);
		$this->validate($request, ['password' => 'required']);
		
		// si les indentifiants de connexion sont corrects, on dirige vers la homepage
		// if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
		if(Auth::attempt(['token' => $request->token, 'password' => $request->password])){
			// première connection
			if(Auth::user()->story()->first() == null){
				// création de la story
				$story = new Story();
				$story->user_id = Auth::user()->id;
				$story->is_active = 1;
				$story->is_done = 0;
				$story->is_demo = 0;
				$story->created_at = date('Y-m-d H:i:s');
				$story->updated_at = date('Y-m-d H:i:s');
				$story->save();
				
				// création du répertoire
				$path = 'resources/pictures/'.Auth::user()->token; 
				File::makeDirectory($path, $mode = 0777, true, true); 
			}
			
			// si un returnUrl est configuré
			if(isset($request->returnUrl)){
				return Redirect($request->returnUrl);
			}

			// session lors de la connexion
			session()->flash('message', 'Welcome ' . Auth::user()->firstname . ' ' . Auth::user()->lastname);
			session()->flash('color', 'info');
			
			// Redirection
			return Redirect::route("gallery");
			
		// sinon on redirige vers la page de login avec un message d'erreur
        } else {
			return Redirect::route("login")->withErrors(ucfirst(Lang::get('label.incorrect-connexion-params')));
		}
	}
	
	/**
	 * Déconnexion
	 */
	public function logout()
	{
		// supprime la session de l'utilisateur
		Auth::logout();
		
		// redirige vers la page de login
		return Redirect::route("login")->with('message', ucfirst(Lang::get('label.see-you-soon')));
	}

	/**
	 * Signup
	 */
	public function showSignupPage()
	{
		// retourne la vue de création de mot de passe
		return view('signup');
	}

	/**
	 * Permet de créer son mot de passe
	 */
	public function signup(\Illuminate\Http\Request $request)
	{
		// $this->validate($request, ['email' => 'required|email']);
		$this->validate($request, ['collaboratorToken' => 'required']);
		$this->validate($request, ['password' => 'required']);
		$this->validate($request, ['passwordVerif' => 'required']);
		
		// parameters
		$token = $request->collaboratorToken;
		$password = $request->password;
		$passwordVerif = $request->passwordVerif;
		
		// vérification de l'existence du collaborateur dans la base
		$user = User::where('token', '=', $token)->first();
		
		// Si le collaborateur n'existe pas
		if($user == null){
			return Redirect::route("signup")->withErrors(ucfirst(Lang::get('label.user-inexistant')));
		}
		
		// Si le collaborateur a déjà défini un mot de passe
		if($user->password != null){
			return Redirect::route("signup")->withErrors(ucfirst(Lang::get('label.user-already-has-password')));
		}
		
		// Si le mot de passe et sa confirmation ne correspondent pas
		if($password != $passwordVerif){
			return Redirect::route("signup")->withErrors(ucfirst(Lang::get('label.password-and-verif-doesnt-match')));
		}
		
		// génération du mot de passe hashé
		$passwordHash = Hash::make($password);
		
		$user->password = $passwordHash;
		$user->save();
		
		// connexion de l'utilisateur et redirection
		if(Auth::attempt(['token' => $token, 'password' => $password])){
			// première connection
			if(Auth::user()->story()->first() == null){
				// création de la story
				$story = new Story();
				$story->user_id = Auth::user()->id;
				$story->is_active = 1;
				$story->is_done = 0;
				$story->is_demo = 0;
				$story->created_at = date('Y-m-d H:i:s');
				$story->updated_at = date('Y-m-d H:i:s');
				$story->save();
				
				// création du répertoire
				$path = 'resources/pictures/'.Auth::user()->token; 
				File::makeDirectory($path, $mode = 0777, true, true); 
			}
			
			// Redirection
			return Redirect::route("gallery");
			
		// sinon on redirige vers la page de login avec un message d'erreur
        } else {
			return Redirect::route("login")->withErrors(ucfirst(Lang::get('label.error-happened')));
		}
	}
}