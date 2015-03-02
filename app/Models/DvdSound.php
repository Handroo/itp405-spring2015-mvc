<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DvdSound extends Model{
    protected $table = 'sounds';
    public function dvd()
    {
        return $this->hasMany('App\Models\Dvd');
    }

}