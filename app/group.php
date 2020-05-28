<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    //
    protected $table =  "f_group";
    protected $fillable = ['id','title','slug','img_url','created_at','updated_at'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function recipe_group(){
        return $this->hasMany('app\recipe_group','group_id','id');
    }

    public function recipe(){
        return $this->belongsToMany('App\Recipe','f_recipe_group','id_group','id_recipe');
    }
}
