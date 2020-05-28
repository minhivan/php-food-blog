<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thanhvien extends Model
{
    //
    protected $table = "user";
    protected $fillable = ['id','login','pwd','email','fname','lname','fb_url','role','created_at','updated_at'];
    protected $guarded = ['id','email','login'];
    protected $primaryKey = 'id';
}
