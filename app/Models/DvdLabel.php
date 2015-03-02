<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DvdLabel extends Model{
    protected $table = 'labels';
    public function dvd()
    {
        return $this->hasMany('App\Models\Dvd');
    }

}