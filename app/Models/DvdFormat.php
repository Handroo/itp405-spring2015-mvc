<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DvdFormat extends Model{
    protected $table = 'formats';
    public function dvd()
    {
        return $this->hasMany('App\Models\Dvd');
    }

}