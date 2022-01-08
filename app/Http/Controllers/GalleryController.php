<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Datetime;
use File;
use Lang;
use Response;
use Redirect;

use App\Story;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
	// Show gallery page
	public function showGalleryPage(){
		/*// première connection
		if(Auth::user()->story()->first() == null){
			// création de la story
			$story = new Story();
			$story->user_id = Auth::user()->id;
			$story->is_active = 1;
			$story->is_done = 0;
			$story->is_demo = 0;
			$story->created_at = date('Y-m-d H:i:s');
			$story->updated_at = date('Y-m-d H:i:s');
			// $story->save();
			
			// création du répertoire
			$path = 'resources/pictures/'.Auth::user()->token; 
			File::makeDirectory($path, $mode = 0777, true, true); 
		}*/
		
		// si l'utilisateur est authentifié
		if(Auth::check()){
			// parameters
			$stories= $lastStories = $oldStories = [];
			$storyCount = 0;
			
			// Vérification liée à la dernière connexion de l'utilisateur
			if(Auth::user()->last_connection == null){
				$firstConnection = true;
				// on récupère la liste des stories
				$stories = Story::getStories(Auth::user()->id);
			
				// compte des stories
				$storyCount = count($stories);
			} else{
				$firstConnection = false;
				$lastStories = Story::getLastStories(Auth::user()->id, Auth::user()->last_connection);
				// anciennes stories en fonction du nombre de nouvelles
				if(count($lastStories) > 0){
					$oldStories = Story::getOldStories(Auth::user()->id, Auth::user()->last_connection);
					
					// compte des stories
					$storyCount = count($lastStories) + count($oldStories);
				} else{
					$stories = Story::getStories(Auth::user()->id);
			
					// compte des stories
					$storyCount = count($stories);
				}
			}
			// dd($stories);
			// dd($stories->take(4)->get());
			// dd($laststories);
			// dd($oldstories);
			
			// compte des stories
			// dd($storyCount);
			
			// mise à jour de la date de dernière connexion
			$date = new Datetime();
			Auth::user()->last_connection = $date->format('Y-m-d H:i:s');
			Auth::user()->save();
			
			return view('gallery', ['stories' => $stories, 'lastStories' => $lastStories, 'oldStories' => $oldStories, 'storyCount' => $storyCount, 'firstConnection' => $firstConnection]);
		} else{
			// return Redirect::route("showLogin")->withErrors(Lang::get('label.must-be-logged'));
			return Redirect::route("login")->with('message', ucfirst(Lang::get('label.please-login')));
		}
	}
	
	// 
	public function gallerySearchResult(\Illuminate\Http\Request $request){
		// si l'utilisateur est authentifié
		if(Auth::check()){
			// 
			$search = $request->searchInput;
			
			// on récupère la liste des stories
			$stories = Story::getStoriesByName(Auth::user()->id, $search);
			
			return view('gallery', ['stories' => $stories, 'storyCount' => count($stories), 'search' => $search]);
		} else{
			// return Redirect::route("showLogin")->withErrors(Lang::get('label.must-be-logged'));
			return Redirect::route("login")->with('message', ucfirst(Lang::get('label.please-login')));
		}
	}
	
	
	/**
	*	Ajax methods
	**/
	// post method
	public function getMoreStories(\Illuminate\Http\Request $request) 
	{
		// préparation du tableau de retour
		$result = ["status" => "error", "message" => "", "data" => []];
		
		// récupération des paramètres
		$userId = $request->json('userId');
		$storyCount = $request->json('storyCount');
		$search = $request->json('search');
		
		$result['data']['stories'] = Story::getMore(Auth::user()->id, $storyCount, $search);
		
		// on stocke les données et on indique que c'est un succès
		$result['status'] = "success";

		return Response::json($result);
	}
}