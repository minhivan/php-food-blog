<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recipe_gallery extends Model
{
    //
    protected $table = "f_recipe_gallery";

    public function image(){
        return $this->hasMany('app\image','img_id','id');
    }
    public function recipe(){
        return $this->hasMany('app\recipe','recipe_id','id');
    }
}
