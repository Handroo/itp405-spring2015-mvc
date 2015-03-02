<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DvdRating extends Model{
    protected $table = 'ratings';
    public function dvd()
    {
        return $this->hasMany('App\Models\Dvd');
    }

}