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
use App\Models\DvdGenre;
use App\Models\DvdLabel;
use App\Models\DvdSound;
use App\Models\DvdRating;
use App\Models\DvdFormat;
use App\Services\RottenTomatoes;
use \Cache;


class DvdController extends Controller{
    public function search(){
//        $genres = (new Dvd())->getGenres();
        $genres = DvdGenre::all();
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

    public function getDvdDetails($id){//this is where we call the rotten tomatoes api
        $movieFound = true;
        $moviePicURL = "";
        $critic_score = "";
        $audience_score = "";
        $runtime = "";
        $abridged_cast = [];
        $movieTitle = (new Dvd())->getDvdInfo($id)[0]->title;

        $jsonString = RottenTomatoes::search($movieTitle);

        $rtdata = json_decode($jsonString);
        if(count($rtdata->movies) == 0){
            $movieFound = false;


        }else{
            $maxMatchChar = 0;
            $maxMatchIndex = 0;
            for($i = 0; $i < count($rtdata->movies); $i++){
                if(similar_text($movieTitle,$rtdata->movies[$i]->title) > $maxMatchChar){
                    $maxMatchChar = similar_text($movieTitle,$rtdata->movies[$i]->title);
                    $maxMatchIndex = $i;
                }
            }
            $moviePicURL = $rtdata->movies[$maxMatchIndex]->posters->profile;
            $critic_score = $rtdata->movies[$maxMatchIndex]->ratings->critics_score;
            $audience_score = $rtdata->movies[$maxMatchIndex]->ratings->audience_score;
            $runtime = $rtdata->movies[$maxMatchIndex]->runtime;
            $abridged_cast = $rtdata->movies[$maxMatchIndex]->abridged_cast;
        }

        $dvdInfo = (new Dvd())->getDvdInfo($id);
        $dvdReviews = (new Dvd())->getDvdReviews($id);
        $ratingRange = array("1", "2", "3", "4","5","6","7","8","9","10");


//        dd(similar_text($dvdInfo[0]->title),);
        return view('dvdreview',[
            'dvdInfo' => $dvdInfo,
            'ratingRange' => $ratingRange,
            'dvdReviews' => $dvdReviews,
            'movieFound' => $movieFound,
            'moviePicURL' => $moviePicURL,
            'critic_score'=> $critic_score,
            'audience_score' => $audience_score,
            'runtime' => $runtime,
            'abridged_cast' => $abridged_cast
        ]);
    }



    public function submitReview(Request $request){
        $validation = Dvd::validateReview($request->all());
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

    public function createDvd(){

        $genres = DvdGenre::all();
        $labels = DvdLabel::all();
        $sounds = DvdSound::all();
        $ratings = DvdRating::all();
        $formats = DvdFormat::all();

        return view('dvdcreate',[
            'genres' => $genres,
            'labels' => $labels,
            'sounds' => $sounds,
            'ratings' => $ratings,
            'formats' => $formats
        ]);
    }
    public function createDvdSubmit(Request $request){
//        dd($request);
        $validation = Dvd::validateCreation($request->all());
        if($validation->passes()){
            Dvd::createDvd([
                'title' => $request->input('title'),
                'genre_id' => $request->input('genre'),
                'label_id' => $request->input('label'),
                'sound_id' => $request->input('sound'),
                'rating_id' => $request->input('rating'),
                'format_id' => $request->input('format')

            ]);
            return redirect('/dvds/create')->with('success','Review successfully saved!');
        }else{
            return redirect('/dvds/create')
                ->withInput()
                ->withErrors($validation);
        }
    }
    public function dvdsWithGenre($genrename){
        $name = rawurldecode($genrename);
        $genre = DvdGenre::where('genre_name', 'LIKE', $name)->get();
        $g_id = $genre[0]->id;

        $dvds = Dvd::with('genre','format','label','rating','sound')->where('genre_id','=',$g_id)->get();

        foreach ($dvds as $d)
        {
            $d->dvd_id = $d->id;
            $d->genre_name = $d->genre->genre_name;
            if($d->format) {
                $d->format_name = $d->format->format_name;
            }
            $d->label_name = $d->label->label_name;
            $d->rating_name = $d->rating->rating_name;
            $d->sound_name = $d->sound->sound_name;
        }
        return view('dvdresults',[
            'dvd_title' => 'All',
            'genre' => $genrename,
            'rating' => 'All',
            'dvds' => $dvds
        ]);
    }


}