<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class user extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //
    use Notifiable;
    use Authenticatable;
    protected $table = "user";
    protected $fillable = ['login','password','email'];
    protected $guarded = ['id','email','login','password'];
    protected $primaryKey = 'id';

    public function recipe(){
        return $this->hasMany('app\recipe','recipe_id','id');
    }

}
