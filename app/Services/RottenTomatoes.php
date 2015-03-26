<?php namespace App\Services;

use App\User;
use \Cache;

class RottenTomatoes{


    public static function search($dvd_title)
    {
        if(Cache::has("rt-$dvd_title")){
            $jsonString = Cache::get("rt-$dvd_title");
        }else{
            $url = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=v9t2fmzj87ykahnwmjhzyjac&q='.urlencode($dvd_title);
            $jsonString = file_get_contents($url); // this variable now contains the string of JSON
            Cache::put("rt-$dvd_title", $jsonString, 60);
        }
        return $jsonString;
    }

}
