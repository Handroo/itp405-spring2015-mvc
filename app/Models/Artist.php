<?php
/**
 * Created by PhpStorm.
 * User: davidtang
 * Date: 2/24/15
 * Time: 6:26 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model {

    public function songs()
    {
        return $this->hasMany('App\Models\Song');
    }

    public function jam()
    {
        echo 'jamming';
    }
}