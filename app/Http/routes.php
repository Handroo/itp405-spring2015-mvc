<?php
use App\Models\Artist;
use App\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('signup',function(){

    return view('signup');
});
Route::post('signup',function(){

    $validation = User::validate(Request::all());
    if($validation->passes()){
        $user = new User();
        $user->name = Request::input('name');
        $user->email = Request::input('email');
        $user->password = Hash::make(Request::input('password'));
        $user->save();
        Auth::loginUsingId($user->id);
        return redirect('dashboard');
    }

    return redirect('signup')->withErrors($validation->errors());
});

Route::post('login',function(){

    $credentials = [
        'email'=>Request::input('email'),
        'password'=>Request::input('password')
    ];
    $remember_me = Request::input('remember_me') == 'on' ? true : false;
    if(Auth::attempt($credentials,$remember_me)){
//        return redirect('dashboard');
        return redirect()->intended();
    }
    return redirect('login');

    return redirect('signup')->withErrors($validation->errors());
});

Route::get('login',function(){
    return view('login');
});

Route::get('logout',function(){
    Auth::logout();
    return redirect('login');
});

Route::get('dashboard',['middleware'=>'auth',function(){
//    if(Auth::check()){
        return view('dashboard');
//    }
//    return redirect('login');
}]);

Route::get('password',['middleware'=>'auth',function(){

    dd('edit pass');

}]);

//DVD Homework
Route::get('/dvds/search','DvdController@search');
Route::get('/dvds','DvdController@results');


//FEB 10 Class Example
//Route::get('/songs/search','SongsController@search');
//Route::get('/songs','SongsController@results');

//FEB 17 Class Example
Route::get('/songs/new','SongController@create');
Route::post('/songs','SongController@storeSong');

//DVD Homework Part 2

Route::post('/dvds/submitReview','DvdController@submitReview');

//DVD Homework Part 3
Route::get('/dvds/create','DvdController@createDvd');
Route::post('/dvds/createDvdSubmit','DvdController@createDvdSubmit');
Route::get('/genres/{genrename}/dvds','DvdController@dvdsWithGenre');

Route::get('/dvds/{id}','DvdController@getDvdDetails');



Route::get('instagram/{tag?}',function($tag = 'catsofinstagram'){

    if(Cache::has("instagram-$tag")){
        $jsonString = Cache::get("instagram-$tag");
    }else{
        $url = "https://api.instagram.com/v1/tags/$tag/media/recent?client_id=18d3e66a27794277be584c98feaa8b8c";
        $jsonString = file_get_contents($url);
        Cache::put("instagram-$tag", $jsonString, 10);
    }



    $instagramdata = json_decode($jsonString);

    return view('instagram',[
        'instagrams' => $instagramdata->data
    ]);

//    echo $jsonString;
});

Route::get('api/v1/artists',function(){
    return Artist::all();

});

Route::get('api/v1/artists/{id}',function($id){
    $artist =  Artist::find($id);

    if(!$artist){
        return Response::json([
            'error' => 404,
            'message' => 'Artist not found'
        ],404);
    }

    return $artist;

});

Route::delete('api/v1/artists/{id}',function($id){
    $artist = Artist::find($id);
    $artist->delete();

    return $artist;

});

Route::get('token',function(){
    return csrf_token();
});

Route::post('api/v1/artists',function(){
    $artist = new Artist();
    $artist->artist_name = Request::input('artist_name');
    $artist->save();
    return $artist;
});

Route::put('api/v1/artists/{id}',function($id){
    $artist = Artist::find($id);
    if(!$artist){
        return Response::json([
            'error' => 404,
            'message' => 'Artist not found'
        ],404);
    }

    $artist->artist_name = Request::input('artist_name');
    $artist->save();
    return $artist;

});