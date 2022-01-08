<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'firstname', 'lastname', 'email', 'token', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	/**
     * eager loading
     */
	public function story()
    {
        return $this->hasOne('App\Story');
    }
	
	public function likes()
    {
        return $this->hasMany('App\Like');
    }
	
	public function region()
    {
        return $this->belongsTo('App\Region', 'region_id')->first();
    }
	public function responsible()
    {
        return $this->belongsTo('App\Responsible', 'responsible_id')->first();
    }
	
	/**
     * methods
     */
	public function getFullname()
	{
		return $this->firstname.' '.$this->lastname;
	}
	
	/**
	* static methods
	*/
	// renvoie un utilisateur par son token
	public static function getUserByToken($token)
	{
		return User::where('token', '=', $token)->first();
	}

    // Cooptation
    public function historics()
    {
        return $this->hasMany('App\Historic');
    }

    public function account()
    {
        return $this->hasMany('App\Account');
    }


     // Cooptation
    public function offre()
    {
        return $this->hasMany('App\Offre');
    }
}
