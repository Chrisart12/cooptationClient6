<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
     protected $fillable = [ "id", "user_id", "candidat_id", "step_id", "admin_id", "admin_lastname", "admin_firstname"];

     //Les relations
     public function user()
     {
         return $this->belongsTo('App\User');
     }

     public function candidat()
     {
         return $this->belongsTo('App\Candidat');
     }

     public function step()
     {
         return $this->belongsTo('App\Step');
     }
}
