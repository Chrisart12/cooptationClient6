<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Datetime;
use Lang;
use Response;
use Redirect;

use App\Like;
use App\Story;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;

class StoryController extends Controller
{
	// Show mystory page
	public function showMyStoryPage(){
		// si l'utilisateur est authentifié
		if(Auth::check()){
			// on vérifie si la story n'a pas déjà été validée définitivement
			if(Auth::user()->story->is_done){
				return Redirect::route("mystorydone");
			}
			
			return view('mystory');
		} else{
			return Redirect::route("login")->with('message', ucfirst(Lang::get('label.please-login')));
		}
	}
	// Show mystory content page
	public function showMyStoryResizePage(){
		// si l'utilisateur est authentifié
		if(Auth::check()){
			// on vérifie si la story n'a pas déjà été validée définitivement
			if(Auth::user()->story->is_done){
				return Redirect::route("mystorydone");
			}
			
			// On vérifie si l'utilisateur a déjà une photo de définie
			if(Auth::user()->story->picture_path == null){
				return Redirect::route("mystory");
			}
			
			return view('mystoryresize');
		} else{
			return Redirect::route("login")->with('message', ucfirst(Lang::get('label.please-login')));
		}
	}
	// Show mystory content page
	public function showMyStoryContentPage(){
		// si l'utilisateur est authentifié
		if(Auth::check()){
			// on vérifie si la story n'a pas déjà été validée définitivement
			if(Auth::user()->story->is_done){
				return Redirect::route("mystorydone");
			}
			
			// On vérifie si l'utilisateur a déjà une photo de définie
			if(Auth::user()->story->picture_path == null){
				return Redirect::route("mystory");
			}
			
			return view('mystorycontent');
		} else{
			return Redirect::route("login")->with('message', ucfirst(Lang::get('label.please-login')));
		}
	}
	// Show mystory validation page
	public function showMyStoryValidationPage(){
		// si l'utilisateur est authentifié
		if(Auth::check()){
			// on vérifie si la story n'a pas déjà été validée définitivement
			if(Auth::user()->story->is_done){
				return Redirect::route("mystorydone");
			}
			
			// On vérifie si l'utilisateur a une photo de définie
			if(Auth::user()->story->picture_path == null){
				return Redirect::route("mystory");
			}
			// On vérifie si l'utilisateur a une story de définie
			if(Auth::user()->story->story == null){
				return Redirect::route("mystorycontent");
			}
			
			return view('mystoryvalidation');
		} else{
			return Redirect::route("login")->with('message', ucfirst(Lang::get('label.please-login')));
		}
	}
	// Show mystorydone page
	public function showMyStoryDonePage(){
		// si l'utilisateur est authentifié
		if(Auth::check()){
			return view('mystorydone');
		} else{
			return Redirect::route("login")->with('message', ucfirst(Lang::get('label.please-login')));
		}
	}
	// Show mystory page
	public function showStoryPage($from, $storyId){
		// si l'utilisateur est authentifié
		if(Auth::check()){
			// Récupération de la story
			$story = Story::find($storyId);
			
			// dd($story->likes()->where('user_id', '=', '2')->count());
			
			// Vérification de l'existence de la story
			if($story != null){
				return view('story', ['from' => $from, 'story' => $story]);
			} else{
				return Redirect::route("gallery");
			}
		} else{
			// return Redirect::route("showLogin")->withErrors(Lang::get('label.must-be-logged'));
			return Redirect::route("login")->with('message', ucfirst(Lang::get('label.please-login')));
		}
	}
	
	// 
	public function setMyStoryPicture(\Illuminate\Http\Request $request){
		$image = $request->file('image');
		
		// var_dump(Auth::user()->story->picture_path);
		// dd($request->image);
		
		$this->validate($request, [
			// 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'image' => 'required|image|mimes:jpeg,png,jpg',
		]);
		
		// picture name
		$imageName = Auth::user()->token. '.' .$request->image->getClientOriginalExtension();
		$imagePath = 'resources/pictures/'.Auth::user()->token.'/'.$imageName;
		
		// if picture already exist
		if(file_exists($imagePath)){
			unlink($imagePath);
		}
		
		// save picture
		$request->image->move('resources/pictures/'.Auth::user()->token.'/', $imageName);
		
		if (function_exists('exif_read_data')) {
			$filename = 'resources/pictures/'.Auth::user()->token.'/'.$imageName;
			// $filename = 'C:/Users/barri_000/OneDrive/Images/inverted.jpg';
			try {
				$exif = @exif_read_data($filename); // @ to prevent php bug with exif_read_data
			}
			catch (Exception $exp) {
				$exif = false;
			}
			// dd($exif);
			if($exif && isset($exif['Orientation'])) {
				$orientation = $exif['Orientation'];
				if($orientation != 1){
					try {
						$img = @imagecreatefromjpeg($filename); // @ to prevent php bug with imagecreatefromjpeg
					}
					catch (Exception $exp) {
						$img = false;
					}
					// dd($img);
					$deg = 0;
					switch ($orientation) {
						case 3:
						$deg = 180;
						break;
						case 6:
						$deg = 270;
						break;
						case 8:
						$deg = 90;
						break;
					}
					if ($deg) {
						$img = imagerotate($img, $deg, 0);        
					}
					// then rewrite the rotated image back to the disk as $filename 
					imagejpeg($img, $filename, 95);
				} // if there is some rotation necessary
			} // if have the exif orientation info
		} // if function exists
		
		//On enregistre la nouvelle image de l'utilisateur
		Auth::user()->story->picture_path = $imageName;
		Auth::user()->story->save();
		
		// return Redirect::route("mystorycontent");
		return Redirect::route("mystoryresize");
	}
	
	// 
	public function setMyStoryResize(\Illuminate\Http\Request $request){
		$this->validate($request, ['bgPositionX' => 'required']);
		$this->validate($request, ['bgPositionY' => 'required']);
		
		// parameters
		$bgPositionX = $request->bgPositionX;
		$bgPositionY = $request->bgPositionY;
		
		//On enregistre le recadrage de l'utilisateur
		Auth::user()->story->bg_position_x = $bgPositionX;
		Auth::user()->story->bg_position_y = $bgPositionY;
		Auth::user()->story->save();
		
		return Redirect::route("mystorycontent");
	}
	
	// 
	public function setMyStoryContent(\Illuminate\Http\Request $request){
		$this->validate($request, ['myStoryContent' => 'required']);
		
		// parameters
		$storyContent = $request->myStoryContent;
		
		// echo json_decode('"\uD83D\uDE00"');
		// echo json_encode($storyContent);
		// echo json_decode(json_encode($storyContent));
		// dd($storyContent);
		
		//On enregistre la nouvelle story de l'utilisateur
		Auth::user()->story->story = json_encode($storyContent);
		Auth::user()->story->save();
		
		return Redirect::route("mystoryvalidation");
	}
	
	// 
	public function setMyStoryValidation(\Illuminate\Http\Request $request){
		//On valide définitivement la story de l'utilisateur
		Auth::user()->story->is_done = true;
		Auth::user()->story->save();
		
		return Redirect::route("mystorydone");
	}
	
	/**
	*	Ajax methods
	**/
	// post method
	public function updateLike(\Illuminate\Http\Request $request) 
	{
		// préparation du tableau de retour
		$result = ["status" => "error", "message" => "", "data" => []];
		
		// récupération des paramètres
		$userId = $request->json('userId');
		$storyId = $request->json('storyId');
		
		// vérification de l'existence de l'utilisateur
		$user = User::find($userId);
		// si l'utilisateur n'existe pas
		if($user == null){
			$result['message'] = ucfirst(Lang::get('label.userInexistant'));
			return Response::json($result);
		}
		
		// vérification de l'existence de la story
		$story = Story::find($storyId);
		// si la story n'existe pas
		if($story == null){
			$result['message'] = ucfirst(Lang::get('label.storyInexistant'));
			return Response::json($result);
		}
		
		// vérification de l'existence potentielle du like
		$like = Like::where('user_id', '=', $userId)->where('story_id', '=', $storyId)->first();
		// si un like existe déjà, on le supprime
		if($like != null){
			$like->delete();
			
			// on vérifie que le like a bien été supprimé
			$like = Like::where('user_id', '=', $userId)->where('story_id', '=', $storyId)->first();
			// si ce n'est pas le cas
			if($like != null){
				$result['message'] = ucfirst(Lang::get('label.error'));
				return Response::json($result);
			}
			
			$result['data'] = 'delete';
		} else{ // sinon on l'ajoute
			$like = Like::creation($userId, $storyId);
			
			// on vérifie que le like a bien été créé
			$like = Like::where('user_id', '=', $userId)->where('story_id', '=', $storyId)->first();
			// si ce n'est pas le cas
			if($like == null){
				$result['message'] = ucfirst(Lang::get('label.error'));
				return Response::json($result);
			}
			
			$result['data'] = 'creation';
		}
		
		// on stocke les données et on indique que c'est un succès
		$result['status'] = "success";

		return Response::json($result);
	}
}