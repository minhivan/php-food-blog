<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class save_recipe extends Model
{
    //
    protected $table =  "f_save_recipe";
    protected $fillable = ['id','id_recipe','id_user','created_at','updated_at'];
    protected $guarded = ['id','id_recipe','id_user'];
    protected $primaryKey = 'id';


    public function user(){
        return $this->belongsTo('App\user','id_user','id');
    }

    public function recipe(){
        return $this->belongsTo('App\recipe','id_recipe','id');
    }



}
