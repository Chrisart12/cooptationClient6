<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ["id", "score", "user_id", "candidat_id", "step_id"];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function candidat()
    {
    	return $this->belongsTo('App\Candidat', 'candidat_id');
    }
}
