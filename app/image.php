<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\thanhvien;
use App\recipe_comment;
use App\recipe;
use App\recipe_gallery;
class image extends Model
{
    //
    protected $table = "f_image";


    public function user(){
        return $this->belongsTo('App\thanhvien','id_user','id');
    }
    public function recipe(){
        return $this->hasMany('app\recipe','recipe_id');
    }


}
