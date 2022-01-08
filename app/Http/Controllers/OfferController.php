<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Auth;
use DB;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CandidatsRequest;
use Illuminate\Support\Facades\Config;
use App\User;
use App\Candidat;
use App\Historic;
use App\Step;
use App\Account;
use App\Offre;

class OfferController extends Controller
{
		/**
		 * Affiche le formulaire permettant de proposer un candidat
		*/
		public function showFormOffer($id)
    {
				// Si l'utilisateur n'est pas authentifié
				if(!Auth::check()){
						return view('login');
				// sinon on le redirige vers la page des offres
				} else {
				//Affichage d'une offres par son id
						$offre = Offre::findOrFail($id);
				
				return view('offer', compact('offre'));
				}
		}
		

		/**
		 * Traite le formulaire de proposition de candidat
		*/
    public function postFormOffer(CandidatsRequest $request, $id)
    {
		
		//Insertion des candidats dans la table candidats.
		//On utilise une transaction
		DB::beginTransaction();

		try {
						//Récupération des données de l'offre dans la tables offres
						$offre = Offre::findOrFail($id);

						$candidat = new Candidat;
						$candidat->lastName = $request->input('lastName');
						$candidat->firstName = $request->input('firstName');
						$candidat->reference =  $offre->reference;
						$candidat->poste = $offre->poste;
						$candidat->offre_id = $offre->id;
						$candidat->save();

						//Insertion du score dans la table accounts.
						//Le score est à 0 lors de l'envoi du candidat
						//Le step est à 1 lors de l'envoi du candidat
						$account = new Account;
						$account->score = 0;
						$account->user_id = Auth::user()->id;
						$account->candidat_id = $candidat->id;
						$account->step_id = 1;
						$account->is_done = 0;
						$account->save();

						// //Insertion de l'historique dans la table historics.
						// $historic = new Historic;
						// $historic->user_id = Auth::user()->id;
						// $historic->candidat_id = $candidat->id;
						// $historic->step_id = 1;
						// $historic->save();

				} catch (ValidationException $e) {

						DB::rollback();
					}
						DB::commit();
		
				return view('confirmOffer', compact('candidat'));
		}

		
		/**
		 * Affiche les offres
		*/
		public function showOffer()
    {
		//Affichage de tous les offres de la table offre à l'utilisateur
		//Limitation du nombre d'affichage par page.
		$pagination = Config::get('custom.pagination');
        $offres = Offre::select('offres.id', 'offres.lieu', 'offres.reference', 'offres.categorie_id', 'offres.poste', 'offres.description', 'offres.updated_at')
							  ->paginate($pagination);
                //dd($offres);
		
				return view('offres', compact('offres', 'pagination'));
		}

		/**
		 * Permet de trier lesoffres
		*/
		public function searchOffres(Request $request)
    {
			$query = $request->input('query');
      //dd($query);
      //Affichage de tous les offres de la table offre
      $pagination = Config::get('custom.pagination');

      $offres = Offre::where('offres.lieu', 'like', "%$query%")
                          ->orWhere('offres.reference', 'like', "%$query%")
                          ->orWhere('offres.poste', 'like', "%$query%")
                          ->orWhere('offres.description', 'like', "%$query%")
                          ->orWhere('categories.label', 'like', "%$query%")
                          ->join('categories', 'categories.id', '=', 'offres.categorie_id')
                          
                          
                          //->get();
                          ->paginate($pagination);
                          
                           //dd($offres)
		
				return view('offres', compact('offres', 'pagination'));
		}

		
		/**
		 * Affiche une offre par son id
		*/
		public function showOfferById($id)
		{
			//Affichage d'une offres par son id
				$offre = Offre::findOrFail($id);
			
				return view('offre', compact('offre'));
		}

}
