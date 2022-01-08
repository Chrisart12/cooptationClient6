<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    protected $fillable = ["id", "lastName", "firstName", "reference", "poste", "offre_id"];

    //Les relation
    public function historics()
    {
        return $this->hasMany('App\Historic');
    }

    public function account()
    {
        return $this->hasOne('App\Account');
    }

    public function offre()
    {
    	return $this->belongsTo('App\Offre', 'offre_id');
    }

    //Enrégistrement en majuscule du nom dans la base de données candidats
     /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastNameAttribute($value)
    {

        return $this->attributes['lastName'] = strtoupper($value);
    }

    //Enrégistrement en majuscule de la première lettre du prénom dans la base de données candidats
     /**
     * Set the value of firsttName
     *
     * @return  self
     */ 
    public function setFirtNameAttribute($value)
    {
        return $this->attributes['firstName'] = ucfirst($value);
    }

}
