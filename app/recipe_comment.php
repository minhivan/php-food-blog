<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recipe_comment extends Model
{
    //
    protected $table =  "f_recipe_comment";
    protected $fillable = ['id','recipe_id','content','topic','user_id','created_at','updated_at'];
    protected $guarded = ['id','recipe_id','author_id'];
    protected $primaryKey = 'id';


    public function user(){
        return $this->belongsTo('App\thanhvien','user_id','id');
    }
    public function recipe(){
        return $this->belongsTo('App\recipe','recipe_id','id');
    }
}
