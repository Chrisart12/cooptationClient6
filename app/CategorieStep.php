<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorieStep extends Model
{
    protected $fillable = [ "id", "step_id", "categorie_id", "ordre"];

    public function categories()
    {
    	return $this->belongsTo('App\Categorie', 'categorie_id');
    }

    public function steps()
    {
    	return $this->belongsTo('App\Step', 'step_id');
    }
}
