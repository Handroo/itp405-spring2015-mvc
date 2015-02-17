<?php namespace App\Models;

use DB;

class Dvd {
    public function getGenres(){
        $query = DB::table("genres");
        return $query->get();
    }
    public function getRatings(){
        $query = DB::table("ratings");
        return $query->get();
    }
    public function search($term,$genre,$rating){
        $query = DB::table("dvds")
            ->join('labels','labels.id','=','dvds.label_id')
            ->join('sounds','sounds.id','=','dvds.sound_id')
            ->join('formats','formats.id','=','dvds.format_id')
            ->join('genres','genres.id','=','dvds.genre_id')
            ->join('ratings','ratings.id','=','dvds.rating_id');
        if($term){
            $query->where('title','LIKE','%' .$term .'%');
        }
        if($genre!="All"){
            $query->where('genre_name','=',$genre );
        }
        if($rating!="All"){
            $query->where('rating_name','=',$rating );
        }
        return $query->get();
    }
}