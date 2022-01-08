<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = ["id", "lieu", "reference", "categorie_id", "poste", "description", "user_id"];


     public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

     // Cooptation
    public function candidats()
    {
        return $this->hasMany('App\Candidat');
    }

    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }

}
