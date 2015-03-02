<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DvdGenre extends Model {
    protected $table = 'genres';
    public function dvd()
    {
        return $this->hasMany('App\Models\Dvd');
    }

}