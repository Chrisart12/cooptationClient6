<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
     protected $fillable = ["id", "label"];

     // public function  steps()
     // {
     // 	return $this->belongsToMany('App\Step');
     // }

     public function categorieSteps()
    {
    	return $this->hasMany('App\CategorieStep');
    }

    public function offres()
    {
    	return $this->hasMany('App\Offre');
    }

    public function steps()
    {
    	return $this->belongsToMany('App\Step');
    }
}
