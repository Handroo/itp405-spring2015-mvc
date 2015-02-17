<?php namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 2/16/15
 * Time: 4:49 PM
 */

use Illuminate\Http\Request;
use DB;
use App\Models\Dvd;

class DvdController extends Controller{
    public function search(){
        $genres = (new Dvd())->getGenres();
        $ratings = (new Dvd())->getRatings();
        return view('dvdsearch',[
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }

    public function results(Request $request){


        if(!$request->input('dvd_title')){
//            return redirect('dvds?dvd_title=&genre=All&rating=All&search=Submit');
            $title = "";
            $genre = "All";
            $rating = "All";
        }else{
            $title = $request->input('dvd_title');
            $genre = $request->input('genre');
            $rating = $request->input('rating');
        }

        $dvds = (new Dvd())->search($title,$genre,$rating);
//        var_dump($request->input('rating'));
//        $query = new SongQuery();


//        dd($genres);
        return view('dvdresults',[
            'dvd_title' => $title,
            'genre' => $genre,
            'rating' => $rating,
            'dvds' => $dvds
        ]);
//        return view('dvdresults');
    }
}