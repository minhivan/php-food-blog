<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\recipe_tag;
class tag extends Model
{
    //
    protected $table =  "f_tag";
    protected $fillable = ['id','title','slug','description','created_at','updated_at'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function recipe_tag(){
        return $this->hasMany('app\recipe_tag','tag_id','id');
    }

    public function recipe(){
        return $this->belongsToMany('App\Recipe','f_recipe_tag','id_tag','id_recipe');
    }
}
