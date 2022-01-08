<?php

namespace App;

use Auth;
use DB;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'story', 'picture_path',
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
	public function likes()
    {
        return $this->hasMany('App\Like');
    }
	public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->first();
    }
	
	/**
     * methods
     */
	public function hasLikeFromUser($userId)
	{
		if($this->likes()->where('user_id', '=', $userId)->count() > 0){
			return true;
		} else{
			return false;
		}
	}
	
	public function getStory(){
		if(json_decode($this->story) != ""){
			return json_decode($this->story);
		} else{
			return $this->story;
		}
	}
	
	/**
	* static methods
	*/
	// renvoie la liste des stories confirmées exceptée celle de l'utilisateur connecté
	public static function getStories($userId)
	{
		if(config('custom.gallery_mode') == 'demo'){
			$isDemo = true;
		} else{
			$isDemo = false;
		}
		
		return Story::/*where('user_id', '!=', $userId)
						->*/where('story', '!=', null)
						->where('picture_path', '!=', null)
						->where('is_active', '=', true)
						->where('is_done', '=', true)
						->where('is_demo', '=', $isDemo)
						->orderBy('stories.updated_at', 'DESC')
						->take(6)
						->get();
	}
	public static function getLastStories($userId, $lastConnection)
	{
		if(config('custom.gallery_mode') == 'demo'){
			$isDemo = true;
		} else{
			$isDemo = false;
		}
		
		return Story::/*where('user_id', '!=', $userId)
						->*/where('story', '!=', null)
						->where('picture_path', '!=', null)
						->where('is_active', '=', true)
						->where('is_done', '=', true)
						->where('is_demo', '=', $isDemo)
						->where('updated_at', '>', $lastConnection)
						->orderBy('stories.updated_at', 'DESC')
						->get();
	}
	public static function getOldStories($userId, $lastConnection)
	{
		if(config('custom.gallery_mode') == 'demo'){
			$isDemo = true;
		} else{
			$isDemo = false;
		}
		
		return Story::/*where('user_id', '!=', $userId)
						->*/where('story', '!=', null)
						->where('picture_path', '!=', null)
						->where('is_active', '=', true)
						->where('is_done', '=', true)
						->where('is_demo', '=', $isDemo)
						->where('updated_at', '<=', $lastConnection)
						->orderBy('stories.updated_at', 'DESC')
						->take(6)
						->get();
	}
	// renvoie la liste des stories confirmées exceptée celle de l'utilisateur connecté, filtrées par une chaine de recherche
	public static function getStoriesByName($userId, $search)
	{
		if(config('custom.gallery_mode') == 'demo'){
			$isDemo = true;
		} else{
			$isDemo = false;
		}
		
		return Story::join('users', 'users.id', '=', 'stories.user_id')
						/*->where('user_id', '!=', $userId)*/
						->where('story', '!=', null)
						->where('picture_path', '!=', null)
						->where('is_active', '=', true)
						->where('is_done', '=', true)
						->where('is_demo', '=', $isDemo)
						->where(function($query) use ($search) {
							$query->where(DB::raw("CONCAT(users.firstname, ' ', users.lastname)"), 'LIKE', '%'.$search.'%');
						})
						->select('stories.*', 'users.*') 
						->orderBy('stories.updated_at', 'DESC')
						->take(6)
						->get();
	}
	// renvoie la liste des stories likées
	public static function getFavorites($userId)
	{
		if(config('custom.gallery_mode') == 'demo'){
			$isDemo = true;
		} else{
			$isDemo = false;
		}
		
		return Story::join('likes', 'likes.story_id', '=', 'stories.id')
						->where('stories.story', '!=', null)
						->where('stories.picture_path', '!=', null)
						->where('stories.is_active', '=', true)
						->where('is_done', '=', true)
						->where('is_demo', '=', $isDemo)
						->where('likes.user_id', '=', $userId)
						// ->select('stories.id', 'stories.user_id', '.stories.story', 'stories.picture_path')
						->select('stories.*')
						->orderBy('stories.updated_at', 'DESC')
						->get();
	}
	// renvoie la liste des stories likées
	public static function getMore($userId, $storyCount, $search)
	{
		if(config('custom.gallery_mode') == 'demo'){
			$isDemo = true;
		} else{
			$isDemo = false;
		}

		$stories = Story::distinct()
						->join('users', 'users.id', '=', 'stories.user_id')
						/*->where('stories.user_id', '!=', $userId)*/
						->where('story', '!=', null)
						->where('picture_path', '!=', null)
						->where('is_active', '=', true)
						->where('is_done', '=', true)
						->where('is_demo', '=', $isDemo)
						->where(function($query) use ($search) {
							$query->where(DB::raw("CONCAT(users.firstname, ' ', users.lastname)"), 'LIKE', '%'.$search.'%');
						})
						->select('*', 'stories.id as story_id')
						// ->withCount('likes')
						->withCount([
							'likes' => function($query) use($userId){
								$query->where('user_id', $userId);
							}
						])
					    ->orderBy('stories.updated_at', 'DESC')
						->skip($storyCount)
						->take(4)
						->get();
		
		return $stories;
	}
	
	// renvoie la liste des top stories classées par nombre de likes
	public static function getTopStories()
	{
		if(config('custom.gallery_mode') == 'demo'){
			$isDemo = true;
		} else{
			$isDemo = false;
		}
		
		return Story::where('story', '!=', null)
						->where('picture_path', '!=', null)
						->where('is_active', '=', true)
						->where('is_done', '=', true)
						->where('is_demo', '=', $isDemo)
						->withCount('likes')
						->orderBy('likes_count', 'DESC')
						->paginate(30);
	}
	
	// renvoie la liste des top stories classées par nombre de likes et filtrées
	public static function getTopStoriesByFilter($filters)
	{
		if(config('custom.gallery_mode') == 'demo'){
			$isDemo = true;
		} else{
			$isDemo = false;
		}
		
		$stories = Story::join('users', 'users.id', '=', 'stories.user_id')
							->where('stories.story', '!=', null)
							->where('stories.picture_path', '!=', null)
							->where('stories.is_active', '=', true)
							->where('stories.is_done', '=', true)
							// ->where('stories.is_demo', '=', $isDemo)
							->where(function($query) use ($isDemo){
								if(Auth::user()->token != 'twinadmin'){
									return $query->where('stories.is_demo', '=', $isDemo);
								}
							})
							// ->where('users.region_id', '=', $filters['region'])
							->where(function($query) use ($filters){
								if($filters['region'] != '-1'){
									return $query->where('users.region_id', '=', $filters['region']);
								}
							})
							->where(function($query) use ($filters){
								if($filters['responsible'] != '-1'){
									return $query->where('users.responsible_id', '=', $filters['responsible']);
								}
							})
							->select('stories.*')
							->withCount('likes')
							->orderBy('likes_count', 'DESC')
							->paginate(30);
		
		/*if($filters['region'] != '-1'){
			$stories = Story::join('users', 'users.id', '=', 'stories.user_id')
							->where('stories.story', '!=', null)
							->where('stories.picture_path', '!=', null)
							->where('stories.is_active', '=', true)
							->where('stories.is_done', '=', true)
							->where('stories.is_demo', '=', $isDemo)
							->where('users.region_id', '=', $filters['region'])
							->select('stories.*')
							->withCount('likes')
							->orderBy('likes_count', 'DESC')
							->paginate(30);
		} else{
			$stories = Story::where('stories.story', '!=', null)
							->where('stories.picture_path', '!=', null)
							->where('stories.is_active', '=', true)
							->where('stories.is_done', '=', true)
							->where('stories.is_demo', '=', $isDemo)
							->select('stories.*')
							->withCount('likes')
							->orderBy('likes_count', 'DESC')
							->paginate(30);
		}*/
		
		return $stories;
	}
}
