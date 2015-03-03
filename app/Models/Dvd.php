<?php namespace App\Models;

use DB;
use Validator;
use Illuminate\Database\Eloquent\Model;

class Dvd extends Model{
    protected $table = 'dvds';
    public static function validateReview($input){
        return Validator::make($input,[
            'title' => 'required',
            'rating' => 'required|integer',
            'comment' => 'required|min:20',
            'dvd_id' => 'required|integer'
        ]);
    }
    public static function validateCreation($input){
        return Validator::make($input,[
            'title' => 'required|min:5',
            'genre' => 'required|integer',
            'label' => 'required|integer',
            'sound' => 'required|integer',
            'rating' => 'required|integer',
            'format' => 'required|integer'
        ]);
    }
    public function getGenres(){
        $query = DB::table("genres");
        return $query->get();
    }
    public function getRatings(){
        $query = DB::table("ratings");
        return $query->get();
    }
    public function search($term,$genre,$rating){
        $query = DB::table("dvds")->select('*', 'dvds.id AS dvd_id')
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
    public function getDvdInfo($id){
        $query = DB::table("dvds")
            ->where('dvds.id','=',$id)
            ->select('*', 'dvds.id AS dvd_id')
            ->join('labels','labels.id','=','dvds.label_id')
            ->join('sounds','sounds.id','=','dvds.sound_id')
            ->join('formats','formats.id','=','dvds.format_id')
            ->join('genres','genres.id','=','dvds.genre_id')
            ->join('ratings','ratings.id','=','dvds.rating_id');
        return $query->get();
    }

    public function getDvdReviews($id){
        $query = DB::table("reviews")
            ->where('dvd_id','=',$id);
        return $query->get();
    }

    public static function createReview($data){
        return DB::table('reviews')->insert($data);
    }

    public static function createDvd($data){
        return DB::table('dvds')->insert($data);
    }

    public function genre(){
        return $this->belongsTo('App\Models\DvdGenre','genre_id');
    }

    public function format(){
        return $this->belongsTo('App\Models\DvdFormat','format_id');
    }

    public function label(){
        return $this->belongsTo('App\Models\DvdLabel','label_id');
    }

    public function rating(){
        return $this->belongsTo('App\Models\DvdRating','rating_id');
    }

    public function sound(){
        return $this->belongsTo('App\Models\DvdSound','sound_id');
    }
}