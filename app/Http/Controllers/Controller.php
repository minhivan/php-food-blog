<?php

namespace App\Http\Controllers;

use App\group;
use App\tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->login();

    }

    function login(){
        if(Auth::check()){
            view()->share(Auth::user()->login,Auth::user()->id,Auth::user()->role);
        }
    }

}
