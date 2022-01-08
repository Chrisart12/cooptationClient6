<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
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
        return $this->belongsTo('App\User', 'user_id');
    }
	public function stories()
    {
        return $this->belongsTo('App\Story', 'story_id');
    }
	
	/**
     * static methods
     */
	public static function creation($userId, $storyId)
    {
      	$instance = new static();
		
		$instance->user_id = $userId;
		$instance->story_id = $storyId;
		$instance->save();
		
    	return $instance;
	}
}
