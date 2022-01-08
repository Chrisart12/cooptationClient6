<?php

namespace App\Http\Controllers;

use Auth;
use Datetime;
use Lang;
use Redirect;
use Response;

use App\Region;
use App\Responsible;
use App\Story;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class AdminController extends Controller
{
	/**
	 * Affiche la page de connexion
	 */
	public function showLoginPage()
	{
		// si l'utilisateur n'est pas authentifié, on affiche la page de login de l'admin
		if(!Auth::check()){
			return view('admin.login');
		// sinon on le redirige vers la galerie de l'admin
		} else{
			if(Auth::user()->role == "admin" ||  Auth::user()->role == "superAdmin"){
				return Redirect::route("admin/gallery");
			} else{
				return Redirect::route("admin/logout");
			}
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
		
		// test d'autorisation
		$user = User::getUserByToken($request->token);
		if($user != null && $user->role != "admin" &&  $user->role != "superAdmin"){
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('admin.access-denied')));
		}
		
		// si les indentifiants de connexion sont corrects, on dirige vers la homepage
		if(Auth::attempt(['token' => $request->token, 'password' => $request->password])){
			// si un returnUrl est configuré
			if(isset($request->returnUrl)){
				return Redirect($request->returnUrl);
			}
			
			// Redirection
			return Redirect::route("admin/gallery");
			
		// sinon on redirige vers la page de login avec un message d'erreur
        } else {
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('admin.incorrect-connexion-params')));
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
		return Redirect::route("admin/login");
	}
	
	// Show gallery page
	public function showGalleryPage(\Illuminate\Http\Request $request){
		// authentification nécessaire
		if(Auth::user() != null){
			if(Auth::user()->role == "admin" || Auth::user()->role == "superAdmin"){
								// parameters
				$region = $request->region != null ? $request->region : -1;
				$responsible = $request->responsible != null ? $request->responsible : -1;
				$isTop30 = $request->isTop30 != null ? true : false;
				
				// var_dump($region);
				// dd($request->region);
				
				// filters
				$filters['region'] = $region;
				$filters['responsible'] = $responsible;
				$filters['isTop30'] = $isTop30;
				
				// var_dump($region);
				
				// récupération des stories
				// $stories = Story::getTopStories();
				$stories = Story::getTopStoriesByFilter($filters);
				$regions = Region::getRegions();
				$responsibles = Responsible::getResponsibles();
				
				// top30
				$s = array();
				$cpt = 1;
				if($filters['isTop30']){
					foreach($stories as $story){
						$s[] = $story;
						$cpt++;
						if($cpt > 30){
							break;
						}
					}
					// $stories = collect($s);
					// dd($stories->items());
					// $stories->items(collect($s));
					// $stories->setCollection(collect($s));
				}
				
				// dd($stories[0]->user()->region());
				// dd($stories);
				
				// regions
				$r = array();
				$r[-1] = ucfirst(Lang::get('admin.all-regions'));
				foreach($regions as $region){
					$r[$region->id] = $region->label;
				}
				$regions = $r;
				
				// responsibles
				$r = array();
				$r[-1] = ucfirst(Lang::get('admin.all-responsibles'));
				foreach($responsibles as $responsible){
					$r[$responsible->id] = $responsible->label;
				}
				$responsibles = $r;
				
				// dd($stories);
				// dd($regions);
				
				return view('admin.gallery', ['stories' => $stories->appends(Input::except('page')), 'regions' => $regions, 'responsibles' => $responsibles, 'filters' => $filters]);
			} else{
				return Redirect::route("admin/logout");
			}
		} else{
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('label.please-login')));
		}
	}
	
	// Show story page
	public function showStoryPage($storyId){
		// authentification nécessaire
		if(Auth::user() != null){
			if(Auth::user()->role == "admin" ||  Auth::user()->role == "superAdmin"){
				// récupération des stories
				$story = Story::find($storyId);
				
				// dd($story);
				
				return view('admin.story', ['story' => $story]);
			} else{
				return Redirect::route("admin/logout");
			}
		} else{
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('label.please-login')));
		}
	}
	
	// 
	/*public function gallerySearchResult(\Illuminate\Http\Request $request){
		// récupération des apramètres postés
		$region = $request->region;
		$responsible = $request->responsible;
		$isTop30 = $request->isTop30 != null ? true : false;
		
		// filters
		$filters['region'] = $region;
		$filters['responsible'] = $responsible;
		$filters['isTop30'] = $isTop30;
		
		// récupération des stories
		$stories = Story::getTopStoriesByFilter($filters);
		$regions = Region::getRegions();
		
		// $count = 1;
		// $limit = 1;
		// $page = 1;
		// $paginator = new Paginator($stories, $count, $limit, $page, [
            // 'path'  => $request->url(),
            // 'query' => $request->query(),
        // ]);
		// $stories = $paginator;
		// dd($stories);
		
		// top30
		if($filters['isTop30']){
			$s = array();
			$cpt = 1;
			// 
			foreach($stories as $story){
				$s[] = $story;
				$cpt++;
				if($cpt > 30){
					break;
				}
			}
			$stories = $s;
		}
		
		// regions
		$r = array();
		$r[-1] = ucfirst(Lang::get('admin.all-regions'));
		foreach($regions as $region){
			$r[$region->id] = $region->label;
		}
		$regions = $r;
		
		// $regions = $regions->pluck('label', 'id')->toArray();
		// array_unshift($regions, ucfirst(Lang::get('admin.all-regions')));
		
		// dd($stories);
		// dd($regions);
		
		return view('admin.gallery', ['stories' => $stories, 'regions' => $regions, 'filters' => $filters]);
	}*/
	
	
	/**
	*	Ajax methods
	**/
	// post method
	public function disableStory(\Illuminate\Http\Request $request) 
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
			$result['message'] = ucfirst(Lang::get('admin.user-inexistant'));
			return Response::json($result);
		}
		
		// vérification de l'existence de la story
		$story = Story::find($storyId);
		// si la story n'existe pas
		if($story == null){
			$result['message'] = ucfirst(Lang::get('admin.story-inexistant'));
			return Response::json($result);
		}
		
		// vérification de la correspondance entre le user et sa story
		if($user->story->id != $story->id){
			$result['message'] = ucfirst(Lang::get('admin.story-error'));
			return Response::json($result);
		}
		
		// désactivation de la story 
		$story->is_done = 0;
		$story->save();
		$result['message'] = ucfirst(Lang::get('admin.story-successfully-disabled'));
		
		// on stocke les données et on indique que c'est un succès
		$result['status'] = "success";

		return Response::json($result);
	}
	// post method
	public function editStory(\Illuminate\Http\Request $request) 
	{
		// préparation du tableau de retour
		$result = ["status" => "error", "message" => "", "data" => []];
		
		// récupération des paramètres
		$userId = $request->json('userId');
		$storyId = $request->json('storyId');
		$storyContent = $request->json('story');
		
		// vérification de l'existence de l'utilisateur
		$user = User::find($userId);
		// si l'utilisateur n'existe pas
		if($user == null){
			$result['message'] = ucfirst(Lang::get('admin.user-inexistant'));
			return Response::json($result);
		}
		
		// vérification de l'existence de la story
		$story = Story::find($storyId);
		// si la story n'existe pas
		if($story == null){
			$result['message'] = ucfirst(Lang::get('admin.story-inexistant'));
			return Response::json($result);
		}
		
		// vérification de la correspondance entre le user et sa story
		if($user->story->id != $story->id){
			$result['message'] = ucfirst(Lang::get('admin.story-error'));
			return Response::json($result);
		}
		
		// vérification de la longueur de la story
		if(strlen($storyContent) <= 0 || strlen($storyContent) >= 350){
			$result['message'] = ucfirst(Lang::get('admin.story-size-error'));
			return Response::json($result);
		}
		
		// mise à jour de la story 
		$story->story = json_encode($storyContent);
		$story->save();
		$result['message'] = ucfirst(Lang::get('admin.story-successfully-updated'));
		
		// on stocke les données et on indique que c'est un succès
		$result['status'] = "success";

		return Response::json($result);
	}
}