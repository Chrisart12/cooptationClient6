<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'label',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        // 'password', 'remember_token',
    ];
	
	/**
     * eager loading
     */
	public function users()
    {
        return $this->hasMany('App\User');
    }
	
	/**
	* static methods
	*/
	// renvoie la liste des régions
	public static function getRegions()
	{
		return Region::orderBy('label')->get();
	}
}
