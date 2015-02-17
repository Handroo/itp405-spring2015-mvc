<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\SongQuery;
class SongsController extends Controller{

    public function search(){
        return view('search');//retruns search.php
    }

    public function results(Request $request){
        if(!$request->input('song_title')){
            return redirect('/songs/search');
        }
//        var_dump($request->input('song_title'));
//        $query = new SongQuery();
        $songs = (new SongQuery())->search($request->input('song_title'));

//        dd($songs);
        return view('results',[
            'song_title' => $request->input('song_title'),
            'songs' => $songs
        ]);
    }
}
