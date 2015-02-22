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
            $title = "";
            $genre = "All";
            $rating = "All";
        }else{
            $title = $request->input('dvd_title');
            $genre = $request->input('genre');
            $rating = $request->input('rating');
        }

        $dvds = (new Dvd())->search($title,$genre,$rating);

        return view('dvdresults',[
            'dvd_title' => $title,
            'genre' => $genre,
            'rating' => $rating,
            'dvds' => $dvds
        ]);
    }

    public function getDvdDetails($id){
        $dvdInfo = (new Dvd())->getDvdInfo($id);
        $dvdReviews = (new Dvd())->getDvdReviews($id);
        $ratingRange = array("1", "2", "3", "4","5","6","7","8","9","10");
//        dd($dvdReviews);
        return view('dvdreview',[
            'dvdInfo' => $dvdInfo,
            'ratingRange' => $ratingRange,
            'dvdReviews' => $dvdReviews
        ]);
    }



    public function submitReview(Request $request){
        $validation = Dvd::validate($request->all());
        if($validation->passes()){
            Dvd::createReview([
                'title' => $request->input('title'),
                'description' => $request->input('comment'),
                'dvd_id' => $request->input('dvd_id'),
                'rating' => $request->input('rating')

            ]);
            return redirect('/dvds/'.$request->input('dvd_id'))->with('success','Review successfully saved!');
        }else{
            return redirect('/dvds/'.$request->input('dvd_id'))
                ->withInput()
                ->withErrors($validation);
        }
    }
}