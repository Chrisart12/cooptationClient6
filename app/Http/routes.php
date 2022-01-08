<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
    // return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	/** Default route **/
	// Route::get('/', ['as' => 'gallery', 'uses' => 'GalleryController@showGalleryPage']);
	Route::get('/', ['as' => '/', 'uses' => 'UserController@showLoginPage']);
	
	/** AdminController **/
	// get
	Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@showGalleryPage']);
	Route::get('admin/gallery', ['as' => 'admin/gallery', 'uses' => 'AdminController@showGalleryPage']);
	Route::get('admin/login', ['as' => 'admin/login', 'uses' => 'AdminController@showLoginPage']);
	Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'AdminController@logout']);
	Route::get('admin/story/{storyId}', ['as' => 'admin/story', 'uses' => 'AdminController@showStoryPage']);
	// Route::get('signup', ['as' => 'signup', 'uses' => 'AdminController@showSignupPage']);
	// post
	// Route::post('admin/gallery', ['as' => 'admin/gallery', 'uses' => 'AdminController@gallerySearchResult']);
	Route::post('admin/login', ['as' => 'admin/login', 'uses' => 'AdminController@login']);
	// Route::post('signup', ['as' => 'signup', 'uses' => 'AdminController@signup']);
	// ajax
	Route::post('admin/disableStory', ['as' => 'admin/disableStory', 'uses' => 'AdminController@disableStory']); // post
	Route::post('admin/editStory', ['as' => 'admin/editStory', 'uses' => 'AdminController@editStory']); // post
	
	/** CguController **/
	Route::get('cgu', ['as' => 'cgu', 'uses' => 'CguController@showCguPage']);
	
	/** FavoriteController **/
	Route::get('favorite', ['as' => 'favorite', 'uses' => 'FavoriteController@showMyFavoritePage']);
	
	/** GalleryController **/
	// get
	Route::get('gallery', ['as' => 'gallery', 'uses' => 'GalleryController@showGalleryPage']);
	// post
	Route::post('gallery', ['as' => 'gallery', 'uses' => 'GalleryController@gallerySearchResult']);
	// ajax
	Route::post('getMoreStories', ['as' => 'getMoreStories', 'uses' => 'GalleryController@getMoreStories']); // post
	
	/** StoryController **/
	// get
	Route::get('mystory', ['as' => 'mystory', 'uses' => 'StoryController@showMyStoryPage']);
	Route::get('mystoryresize', ['as' => 'mystoryresize', 'uses' => 'StoryController@showMyStoryResizePage']);
	Route::get('mystorycontent', ['as' => 'mystorycontent', 'uses' => 'StoryController@showMyStoryContentPage']);
	Route::get('mystoryvalidation', ['as' => 'mystoryvalidation', 'uses' => 'StoryController@showMyStoryValidationPage']);
	Route::get('mystorydone', ['as' => 'mystorydone', 'uses' => 'StoryController@showMyStoryDonePage']);
	Route::get('story', ['as' => 'story', 'uses' => 'GalleryController@showGalleryPage']);
	Route::get('story/{from}/{storyId}', ['as' => 'story', 'uses' => 'StoryController@showStoryPage']);
	// post 
	Route::post('setMyStoryPicture', ['as' => 'setMyStoryPicture', 'uses' => 'StoryController@setMyStoryPicture']);
	Route::post('setMyStoryResize', ['as' => 'setMyStoryResize', 'uses' => 'StoryController@setMyStoryResize']);
	Route::post('setMyStoryContent', ['as' => 'setMyStoryContent', 'uses' => 'StoryController@setMyStoryContent']);
	Route::post('setMyStoryValidation', ['as' => 'setMyStoryValidation', 'uses' => 'StoryController@setMyStoryValidation']);
	// ajax
	Route::post('updateLike', ['as' => 'updateLike', 'uses' => 'StoryController@updateLike']); // post
	// Route::post('story/updateLike', ['as' => 'story/updateLike', 'uses' => 'StoryController@updateLike']); // post
	
	/** UserController **/
	// get
	Route::get('login', ['as' => 'login', 'uses' => 'UserController@showLoginPage']);
	Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@logout']);
	Route::get('signup', ['as' => 'signup', 'uses' => 'UserController@showSignupPage']);
	// post
	Route::post('login', ['as' => 'login', 'uses' => 'UserController@login']);
	Route::post('signup', ['as' => 'signup', 'uses' => 'UserController@signup']);


	// COOPTATION USERS
	Route::get('menu', ['as' => 'menu', 'uses' => 'MenuController@showMenu']);
	Route::get('offer/{id}', ['as' => 'offer', 'uses' => 'OfferController@showFormOffer']);
	Route::post('offer/{id}', ['as' => 'confirmOffer', 'uses' => 'OfferController@postFormOffer']);
	Route::get('offres', ['as' => 'showOffer', 'uses' => 'OfferController@showOffer']);
	Route::post('offres', 'OfferController@searchOffres');
	Route::get('offre/{id}', ['as' => 'showOffer', 'uses' => 'OfferController@showOfferById']);


	//OFFRES ADMIN
	Route::resource('admin/offres', 'OffresController');
	Route::get('admin/jobs', 'JobController@showJobs')->name('admin.jobs');
	Route::get('admin/job/{vacancy_id}', 'JobController@showJob')->name('admin.job');


	// COOPTATION ADMIN
	Route::get('admin/cooptants', ['as' => 'admin.cooptants', 'uses' => 'CooptationController@index']);
	// La vue d'un cooptant avec tous ses cooptés
	Route::get('admin/cooptant/{id}', ['as' => 'admin.cooptant', 'uses' => 'CooptationController@showCooptant']);
	// La vue détaillée d'un candidat
	Route::get('admin/cooptant/candidat/{id}', ['as' => 'admin.candidat', 'uses' => 'CooptationController@showCandidat']);
	// La vue de tous les candidats
	Route::get('admin/candidats', ['as' => 'admin.candidats', 'uses' => 'CooptationController@showCandidats']);
	//Traitement du premier renez-vous
	Route::post('admin/cooptant/candidat/etapes', ['as' => 'admin.etapes', 'uses' => 'CooptationController@etapes']);
	// Vue historic par les super admin
	Route::get('admin/historic', ['as' => 'admin.historic', 'uses' => 'HistoricController@show']);

	
});
