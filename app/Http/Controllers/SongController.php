<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Song;
class SongController extends Controller{
    public function create(){
        $artist = DB::table('artists')->get();
        $genres = DB::table('genres')->get();
        return view('songform',[
            'artists' => $artist,
            'genres' => $genres
        ]);
    }
    public function updateSong(){

    }

    public function storeSong(Request $r){
        //validate the data
        //insert into table if valid
        //if data is invalid redirect back to /songs/new

//        dd($r->all());
        $validation = Song::validate($r->all());

        if($validation->passes()){
            //insert record to db
            Song::create([
               'title' => $r->input('title'),
                'artist_id' => $r->input('artist_id'),
                'genre_id' => $r->input('genre_id'),
                'price' => $r->input('price')

            ]);
            //redirect back to songs/new
            return redirect('/songs/new')->with('success','Song successfully saved');
        }else{
            //redirect to /songs/new with error messages and old input
            return redirect('/songs/new')
                ->withInput()
                ->withErrors($validation);
        }

//        dd($validation->passes());
    }
}