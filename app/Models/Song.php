<?php namespace App\Models;
use DB;
use Validator;
class Song{
    public static function validate($input){
        return Validator::make($input,[
            'title' => 'required',
            'artist_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'price' => 'required|numeric'
        ]);
    }

    public static function create($data){
        return DB::table('songs')->insert($data);
    }
}