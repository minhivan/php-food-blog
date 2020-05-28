<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class recipe_tag extends Model
{
    //
    protected $table =  "f_recipe_tag";
    protected $fillable = ['id','id_recipe','id_tag','created_at','updated_at'];
    protected $guarded = ['id','id_recipe','id_tag'];
    protected $primaryKey = 'id';


    public function recipe(){
        return $this->hasMany('App\recipe');
    }

}
