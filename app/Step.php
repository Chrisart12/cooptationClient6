<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
     protected $fillable = ["id", "step_number", "label", "point"];


     //Les relations
     public function historics()
     {
          return $this->hasMany('App\Historic');
     }
    
     public function  categorieSteps()
     {
     	return $this->hasMany('App\CategorieStep');
     }

     public function categories()
     {
          return $this->belongsToMany('App\Categorie');
     }

}
