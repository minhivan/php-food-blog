<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\category;
use app\tag;
use app\user;
class recipe extends Model
{
    //
    protected $table =  "f_recipe";
    protected $fillable = ['id','title','img_thumb','slug','description','status','step','serve_for','prepare_time','prepare_unit','cook_time','cook_unit','user_id','created_at','updated_at','cat_id'];
    protected $guarded = ['id','cat_id','user_id'];
    protected $primaryKey = 'id';


    public function user(){
        return $this->belongsTo('App\user','user_id');
    }

    public function tag(){
        return $this->belongsToMany(\App\tag::class,'f_recipe_tag','id_recipe','id_tag')->withTimestamps();
    }

    public function category(){
        return $this->belongsTo('App\category','cat_id');
    }
    public function group(){
        return $this->belongsToMany(\App\group::class,'f_recipe_group','id_recipe','id_group')->withTimestamps();
    }

}
