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

/*
* Traitement de l'historique
*/
class HistoricController extends Controller
{
    public function show(Request $request)
    {

    	// authentification nécessaire
		if(Auth::user() != null){
			if(Auth::user()->role == "superAdmin"){
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

				//COOPTATION
				$pagination = Config::get('custom.pagination');

				$historics = Historic::select('historics.admin_lastname', 'historics.admin_firstname', 'historics.created_at', 'steps.label', 'candidats.lastname', 'candidats.firstname' )
									->join('steps', 'steps.id', '=', 'historics.step_id')
									->where('historics.step_id', '>', 1)
									->join('candidats', 'candidats.id', '=', 'historics.candidat_id')
									->paginate($pagination);

				return view('admin.historic', ['stories' => $stories->appends(Input::except('page')), 'regions' => $regions, 'responsibles' => $responsibles, 'filters' => $filters, 'historics' => $historics]);
			} else{

				return Redirect::route("admin/logout");
			}
		} else{
			return Redirect::route("admin/login")->withErrors(ucfirst(Lang::get('label.please-login')));
		}
	}

}
