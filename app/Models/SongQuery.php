<?php namespace App\Models;

use DB;

class SongQuery {
    public function search($term){
        $query = DB::table("songs")
            ->join('artists','artists.id','=','songs.artist_id')
            ->join('genres','genres.id','=','songs.genre_id');
            if($term){
                $query->where('title','LIKE','%' .$term .'%');
            }
            $query->orderBy('artist_name','asc');
            return $query->get();
    }
}