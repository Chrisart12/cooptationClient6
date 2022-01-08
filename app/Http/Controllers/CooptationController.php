<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Datetime;
use Lang;
use Redirect;
use Response;
use App\Http\Requests\CandidatsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use App\Http\Requests;
use App\User;
use App\Region;
use App\Responsible;
use App\Story;
use App\Candidat;
use App\Historic;
use App\Step;
use App\Account;
use App\Categorie;
use App\CategorieStep;


class CooptationController extends Controller
{
   /**
	 * Affiche la vue de cooptation
	*/
   public function index(Request $request)
   {
   	// authentification nécessaire
		if(Auth::user() != null){
			// Authentifié comme admin ou super admin
			if(Auth::user()->role == "admin" || Auth::user()->role == "superAdmin"){
						
				// COOPTATION
				//Sélection des collaborateurs ayant proposé des candidats et affiche le nomde de candiadts proposés par collaborateur ainsi que leur score total
				 $cooptants = Account::select('accounts.user_id', 'u.lastname', 'u.firstname', DB::raw('count(accounts.user_id) as cooptes, sum(accounts.score) as score'))
				 			 ->join('users as u', 'u.id', '=', 'accounts.user_id')
							 ->groupBy('accounts.user_id')
							 ->orderBy('u.lastname')
				 			 ->get();
				 //$cooptants = Account::select('accounts.*')->distinct()->get();
				 //dd($cooptants);
				return view('admin.cooptants', ['cooptants' =>  $cooptants]);
			} else{

				return Redirect::route("admin/logout");
			}
		} else{
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('label.please-login')));
		}
	}


	/**
	 * Affiche la vue du cooptant avec tous ses cooptés
	*/
	public function showCooptant(Request $request, $id)
	{
			// authentification nécessaire
		if(Auth::user() != null){
			if(Auth::user()->role == "admin" || Auth::user()->role == "superAdmin"){
				
				//COOPTATION
				// Sélection du collaborateur à partir de son id
				$cooptant = User::find($id);
				
				// Sélection de tous les cooptés du collaborateur
				$userCooptes = Account::select('accounts.candidat_id', 'accounts.step_id', 'accounts.user_id', 'accounts.score', 
												'candidats.lastname', 'candidats.firstname', 'candidats.reference')
									->where('accounts.user_id', '=', $id)
									->join('candidats', 'candidats.id', '=', 'accounts.candidat_id')
									->get();
									//dd($userCooptes);
				
				return view('admin.cooptant', ['cooptant' =>  $cooptant, 'userCooptes' => $userCooptes]);
			
			} else{

				return Redirect::route("admin/logout");
			}
		} else{
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('label.please-login')));
		}
		
	}


	/**
	 * Affiche la vue de détail du coopté 
	*/
	public function showCandidat($id)
	{
			// authentification nécessaire
		if(Auth::user() != null){
			if(Auth::user()->role == "admin" || Auth::user()->role == "superAdmin"){
					 //Sélection du candidat et ses étapes selon la catégorie
				   $candidat = Candidat::select('candidats.id as candidat_id', 'candidats.lastname', 'candidats.firstname',
												'candidats.reference', 'candidats.created_at', 'offres.poste', 'offres.categorie_id', 
												'categorie_steps.id as categorie_step_id', 'categorie_steps.ordre', 'accounts.is_done')
				   								->where ('candidats.id', '=', $id)
				   								->join('offres','offres.id', '=', 'candidats.offre_id')
				   								->join('categorie_steps', 'categorie_steps.id', '=', 'offres.categorie_id')
				   								->join('accounts', 'candidats.id', '=', 'accounts.candidat_id')
				   								->first();
				   								//dd($candidat);

				   //Selection de l'ordre selon l'id de la catégorie, dans la table Categorie_steps 					
				  $categorieId = $candidat->categorie_id;			
					//dd($categorieId);
				  $ordres = CategorieStep::select('categorie_steps.ordre', 'steps.label', 'step_id')
				  								->join('steps', 'steps.id', '=', 'categorie_steps.step_id')
				  								//->join('categories', 'categories.id', '=', 'categorie_steps.categorie_id')
				  								 ->where('categorie_steps.categorie_id', '=', $categorieId)
				  								 ->orderBy('categorie_steps.ordre') 
												 ->get();
												 //dd($ordres);
												 
				 //Selection de l'étape du candidat dans la table account selon l'id du candidat.
				 $candidatId	= $candidat->candidat_id;

				 $step = Account::select('accounts.step_id', 'categorie_steps.ordre')
				 						->join('categorie_steps', 'categorie_steps.step_id', '=', 'accounts.step_id')
				 						->where('accounts.candidat_id', '=',  $candidatId)
				 						->where('categorie_steps.categorie_id', '=', $categorieId)
				 						->first();
				 						//dd($step->step_id);



				 						//On compte le nombre total d'étapes selon la catégorie
				$totalSteps = CategorieStep::select('categorie_steps.ordre')
													->where('categorie_steps.categorie_id', '=', $categorieId)
													->count();
													//dd($candidat->account());
													//dd($candidat->account()->first());

													// Sélection de toutes les étapes du candidat dans l'historique
				$stepCandidats = Historic::select('historics.step_id', 'historics.created_at', 'steps.label')
										  // ->where([
												//   	['historics.candidat_id', '=', $candidatId ]
												//   	['historics.step_id', '>', 1]
										  // 		])
										  ->where('historics.candidat_id', '=', $candidatId)
										  ->join('steps', 'historics.step_id', '=', 'steps.id')
										  //->orderBy('steps.id')
										  ->orderBy('historics.created_at')
				                          ->get();
				                          //dd($stepCandidats);

				return view('admin.candidat', ['candidat' => $candidat, 'ordres' => $ordres, 'step' => $step, 'totalSteps' => $totalSteps, 'stepCandidats' => $stepCandidats]);
			} else{

				return Redirect::route("admin/logout");
			}
		} else{
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('label.please-login')));
		}
		
	}



	/**
	 * Affiche tous les candidats par ordre alphabétique
	*/
	public function showCandidats(Request $request)
	{
		
		// authentification nécessaire
		if(Auth::user() != null){
			if(Auth::user()->role == "admin" || Auth::user()->role == "superAdmin"){
				
				//COOPTATION
				// Sélection de tous les candidats
				//Lilitation du nombre de candidat par page
				$pagination = Config::get('custom.pagination');
				$candidats = Candidat::select( 'candidats.id', 'candidats.lastname', 'candidats.firstname', 'candidats.poste', 'candidats.created_at')
									->orderBy('candidats.lastname')
									// ->join('steps', 'steps.id', '=', 'accounts.step_id')
									// ->join ('historics', 'steps.id', '=', 'historics.step_id')
									->paginate($pagination);
									//dd($candidats);
									//dd($candidat->creation_date);
									//as creation_date
									//historics.created_at as historic_date

				
				return view('admin.candidats', ['candidats' => $candidats, 'pagination' => $pagination]);
			} else{

				return Redirect::route("admin/logout");
			}
		} else{
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('label.please-login')));
		}
		
	}


	/**
	 * Traitement des étapes
	*/
	public function etapes(Request $request)
	{
		// authentification nécessaire
		if(Auth::user() != null){
			if(Auth::user()->role == "admin" || Auth::user()->role == "superAdmin"){
				
				//COOPTATION
				// Sélection de tous les cooptés du collaborateur
				$candidatId = $request->input('id');
				$categorieId = $request->input('categorie_id');
				//$step = $request->input('categorie_id');

				//dd($categorieId);
				//dd($step);

				$candidat = Account::select('accounts.candidat_id', 'accounts.user_id', 'accounts.step_id', 'accounts.score', 
											'candidats.lastname', 'candidats.firstname', 'candidats.reference', 'candidats.created_at', 
											'steps.label', 'steps.step_number', 'steps.point', 'users.id as admin_id',
				 							'users.lastname as admin_lastname', 'users.firstname as admin_firstname')
									->where('accounts.candidat_id', '=', $candidatId)
									//->where('categorie_steps.categorie_id', '=', $categorieId)
									//->where('categorie_steps.step_id', '=', 'accounts.step_id')
									//->where('offres.categorie_id', '=', $categorieId)
									//->where('step_id', '=', 'ordre')
									//->join('candidats', 'candidats.id', '=', 'accounts.candidat_id')
									->join('candidats', 'accounts.candidat_id',  '=', 'candidats.id')
									->join('offres', 'candidats.offre_id', '=', 'offres.id')
									//->join('categorie_steps', 'categorie_steps.categorie_id', '=', 'offres.categorie_id')
									->join('steps', 'accounts.step_id', '=','steps.id')
									->join('users', 'accounts.user_id', '=', 'users.id' )
									->first();
				//dd($candidat);
				/*$candidat = Account::select('accounts.*', 'candidats.firstname', 'offres.poste', 'offres.categorie_id', 'categories.label', 'steps.label')
									->join('candidats', 'candidats.id', '=', 'accounts.candidat_id')
									->join('offres', 'offres.id', '=', 'candidats.offre_id')
									->join('categories', 'categories.id', '=', 'offres.categorie_id')
									->join('steps', 'steps.id', '=', 'accounts.step_id')
									// ->join('categorie_steps', 'categorie_steps.step_id', '=', 'steps.id')
									// ->join('categorie_steps', 'categorie_steps.categorie_id', '=', 'categories.id')
									// ->where ('categorie_steps.step_id', '=', 'steps.id')
									// ->where ('categorie_steps.categorie_id', '=', 2)
									//->where ('categorie_steps.step_id', '=', 'accounts.step_id')
									->get();*/

				// $ordre = CategorieStep::where('step_id', '=', $candidat->step_id)
				// 						->where ('categorie_id', '=', $categorieId)
				// 						->first();
				// 						dd($ordre);

				$ordre = CategorieStep::select('categorie_steps.ordre')
										->where([
												['step_id', '=', $candidat->step_id],
												['categorie_id', '=', $categorieId]
											])
										->first();
										//dd($ordre);

				// Sélection de toutes les étapes du candidat dans l'historique
				$stepCandidats = Historic::select('historics.step_id', 'historics.created_at', 'steps.label')
										  // ->where([
												//   	['historics.candidat_id', '=', $candidatId ]
												//   	['historics.step_id', '>', 1]
										  // 		])
										  ->where('historics.candidat_id', '=', $candidatId)
				                          ->join('steps', 'historics.step_id', '=','steps.id')
				                          ->orderBy('historics.candidat_id')
				                          ->get();
				                          //dd($stepCandidats);

				//Récupération des données du cooptant, du coopté, et de l'admin qui a validé l'étape.					
				$score = $candidat->score;
				//$step = $candidat->step_id;
				$stepPoint = $candidat->point;
				//$candidatId = $candidat->candidat_id; 
				$userId = $candidat->user_id;
				$adminId = $candidat->admin_id;
				$adminLastname = $candidat->admin_lastname;
				$adminFirstname = $candidat->admin_firstname;
				//dd($adminLastname);

				//Mis à jour des données dans la table account
				//On compte le nombre total d'étapes selon la catégorie
				$totalSteps = CategorieStep::select('categorie_steps.ordre')
													->where('categorie_steps.categorie_id', '=', $categorieId)
													->count();
													//dd($totalSteps);

				//Récupération de l'ordre sur la page étape
				$ordres = CategorieStep::select('categorie_steps.ordre', 'steps.label', 'step_id')
				  								->join('steps', 'categorie_steps.step_id', '=', 'steps.id')
				  								//->join('categories', 'categories.id', '=', 'categorie_steps.categorie_id')
				  								 ->where('categorie_steps.categorie_id', '=', $categorieId)
				  								 ->orderBy('categorie_steps.ordre'); 
												 //->get();
												 //dd($ordres);

				// $step = Account::select('accounts.step_id')
				//  						->where('accounts.candidat_id', '=',  $candidatId)
				//  						->first();
				 						//dd($step->step_id);
				

				//On utilise une transaction
				DB::beginTransaction();
				//On vérifie que l'étape finale n'est pas atteinte
				try {

					//Insertion des données dans la table historics après le update
					$historic = new Historic;
					$historic->user_id = $userId;
					$historic->candidat_id = $candidatId;
					$historic->step_id = $candidat->step_id;
					$historic->admin_id = $adminId;
					$historic->admin_lastname = $adminLastname;
					$historic->admin_firstname = $adminFirstname;
					$historic->save();


					if($ordre->ordre < $totalSteps) {
						//var_dump($ordre->ordre)
						$nextStep = $ordre->ordre + 1;

						$step = $ordres->where('categorie_steps.ordre', '=', $nextStep)->first();

						//dd($step);
						if($step != null){
							$account = DB::table('accounts')
									->where('candidat_id', '=', $candidatId)
									->update(['score' => $score + $stepPoint,
											  'step_id' => $step->step_id
											]);
						}

					} else if($ordre->ordre == $totalSteps) {
						 
							$account = DB::table('accounts')
									->where('candidat_id', '=', $candidatId)
									->update(['is_done' => 1]);
						}

				} catch (ValidationException $e) {
					DB::rollback();
				}

				DB::commit();
				
		       return redirect()->action('CooptationController@showCandidat',['id'=> $request->input('id')]);
			   //return view('admin.candidat', ['candidat' => $candidat, 'stepCandidats' => $stepCandidats, 'totalSteps' => $totalSteps, 'ordres' => $ordres, 'step' => $step]);
			} else{

				return Redirect::route("admin/logout");
			}
		} else{
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('label.please-login')));
		}
  		
	 }
}
