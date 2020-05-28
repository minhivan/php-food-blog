<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recipe_group extends Model
{
    //
    protected $table =  "f_recipe_group";
    protected $fillable = ['id','id_recipe','id_group','created_at','updated_at'];
    protected $guarded = ['id','id_recipe','id_group'];
    protected $primaryKey = 'id';

    public function recipe(){
        return $this->belongsTo('App\recipe','id_recipe');
    }
}
