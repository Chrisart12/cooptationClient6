<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Offre;
use Illuminate\Http\Request;
use App\Http\Requests\OffresRequest;
use Illuminate\Support\Facades\Config;

use App\Http\Requests;

class OffresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Affichage de tous les offres de la table offre
      //   $pagination = Config::get('custom.pagination');
      //   $offres = Offre::select('offres.id', 'offres.lieu', 'offres.reference', 'offres.categorie_id', 'offres.poste', 'offres.description', 'offres.updated_at', 'categories.label')
      //                       ->join('categories', 'categories.id', '=', 'offres.categorie_id')
      //                       ->paginate($pagination);
      //                       //->get();
      //                        //dd($offres);
      $query = $request->input('query');
      //dd($query);
      //Affichage de tous les offres de la table offre en les filtrant
      $pagination = Config::get('custom.pagination');

      $offres = Offre::where('offres.lieu', 'like', "%$query%")
                          ->orWhere('offres.reference', 'like', "%$query%")
                          ->orWhere('offres.poste', 'like', "%$query%")
                          ->orWhere('offres.description', 'like', "%$query%")
                          ->orWhere('categories.label', 'like', "%$query%")
                          ->join('categories', 'categories.id', '=', 'offres.categorie_id')
                          ->paginate($pagination); 

         return view('admin.offres', compact('offres', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
         return view('admin.publishOffre');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OffresRequest $request)
    {
      
       //Insertion des offres dans la table offres
       $offre = new Offre;
       $offre->categorie_id = $request->input('categorie_id');
       $offre->lieu = $request->input('lieu');
       $offre->reference = $request->input('reference');
       $offre->poste = $request->input('poste');
       $offre->description = $request->input('description');
       $offre->user_id = Auth::user()->id;
       //dd($offre->user_id);
       $offre->save();

       //dd($offre);

       return view('admin.confirmPublish', compact('offre'));
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   
        $offres = Offre::select('offres.id','offres.poste', 'offres.lieu', 'offres.reference', 'offres.description', 'categories.label')
                             ->join('categories', 'categories.id', '=', 'offres.categorie_id')
                             ->where('offres.id', '=', $id)
                             ->get();
                            // dd($offres);

       return view('admin.offre', compact('offres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $offre = Offre::findOrFail($id);
       return view('admin.edit', compact('offre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OffresRequest $request, $id)
    {
       //Modification des offres dans la table offres
       $offre = Offre::find($id);
       $offre->categorie_id = $request->input('categorie_id');
       $offre->lieu = $request->input('lieu');
       $offre->reference = $request->input('reference');
       $offre->poste = $request->input('poste');
       $offre->description = $request->input('description');
       $offre->user_id = Auth::user()->id;
       $offre->update();

       return view('admin.confirmPublish', compact('offre'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Suppression des offres dans la table.
        $offre = Offre::find($id);
        $offre->delete();
    }

     /**
     * Filtrage des offres.
     *
     * @param  string  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
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
                          
                           //dd($offres);

       return view('admin.offres', compact('offres', 'pagination'));
    }
}
