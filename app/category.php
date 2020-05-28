<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\recipe;
class category extends Model
{
    //
    protected $table =  "f_category";
    protected $fillable = ['id','title','slug','description','img_thumb','created_at','updated_at'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';


    public function recipe(){
        return $this->hasMany('app\recipe','cat_id','id');
    }
//    public function recipe(){
//        return $this->belongsToMany('App\Recipe','f_recipe_cat','cat_id','recipe_id');
//    }

}
