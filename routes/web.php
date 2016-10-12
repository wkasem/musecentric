<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::post('feedback' , 'homeController@feedback');

Route::group(['middleware' => 'guest' ],function(){

  Route::auth();

  Route::get('/', function () {
    return view('welcome');
  });

  Route::get('/admin', 'adminController@showLogin');
  Route::post('/admin/login', 'adminController@login');

});


//admin
Route::group(['middleware' => ['admin']  , 'prefix' => '/admin'],function(){

  Route::get('stats', 'adminController@index');
  Route::post('delete', 'adminController@deleteUser');
  Route::post('delete/warning', 'adminController@deleteWarning');
  Route::get('moreUsers', 'adminController@moreUsers');
  Route::post('conversation/{id}', 'adminController@addToConversation');
  Route::post('new-msg', 'adminController@newMsg');

  Route::get('/logout' , function(){
    Auth::logout();
    return redirect('/');
  });

});


Route::group(['middleware' => ['auth' , 'unverified', 'notadmin'] ],function(){

  //confiramtion
  Route::get('/confirm' , 'confirmController@index');
  Route::get('/confirmation/resend' , 'confirmController@resend');
  Route::get('/confirmation/{code}' , 'confirmController@confirm');

});


Route::group(['middleware' => ['auth' , 'verified' , 'notadmin'] ],function(){

  Route::get('/settings' , 'homeController@showSettings')->name('user.settings');
  Route::get('/subscribe' , 'homeController@subscribe');
  Route::get('/profile/{id}' , 'homeController@showProfile')->name('userProfile');
  Route::get('/notifications' , 'homeController@showNotifications');

  Route::get('/logout' , function(){
    Auth::logout();
    return redirect('/');
  });
  Route::get('/home' , function(){
    return redirect('/gigs');
  });

  Route::post('/user/connect' , 'homeController@userConnect');
  Route::post('/user/unconnect' , 'homeController@userUnconnect');


  //gigs
  Route::get('/gigs' , 'gigController@gigsShow');
  Route::get('/gigs/more' , 'gigController@gigsMore');
  Route::get('/gig/{gig}' , 'gigController@gigShow');
  Route::get('/new-gig' , 'gigController@newgigShow');
  Route::post('/new-gig' , 'gigController@newgig');
  Route::get('/my-gigs' , 'gigController@mygigsShow');
  Route::get('/my-classes' , 'gigController@myclassesShow');
  Route::get('/gig/{id}' , 'gigController@gigShow');
  Route::post('/gig/bid/{id}' , 'gigController@gigBid');
  Route::post('/gig/edit/{id}' , 'gigController@gigEdit');
  Route::post('/gig/hire' , 'gigController@gigHire');
  Route::post('/gig/delete/{id}' , 'gigController@gigDelete');

  Route::post('/gig/offer' , 'offerController@new');


  //teach
  Route::get('/new-teach' , 'teachController@newteachShow');
  Route::post('/new-teach' , 'teachController@newteach');
  Route::post('/teach/enroll/{id}' , 'teachController@teachEnroll');
  Route::post('/teach/edit/{id}' , 'teachController@teachEdit');
  Route::post('/teach/delete/{id}' , 'teachController@teachDelete');
  Route::post('/teach/more' , 'teachController@teachMore');


  //offer
  Route::get('/offer/{id}' , 'offerController@show');
  Route::get('/offer/{offer}/accept' , 'offerController@accept');
  Route::get('/offer/{offer}/decline' , 'offerController@decline');

  //media
  Route::post('/media-upload' , 'mediaController@upload');
  Route::post('/media-delete' , 'mediaController@delete');
  Route::get('/media/{id}/{path}/{file}' , 'mediaController@getMedia');
  Route::get('/media/{id}/{file}' , 'mediaController@getMusic');

  //messages
  Route::get('/messages' , 'messagesController@showMessages');
  Route::get('/messages/{id}' , 'messagesController@addToConversation');
  Route::post('/new-msg' , 'messagesController@newMsg');

});
