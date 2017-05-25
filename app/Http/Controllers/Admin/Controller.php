<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as BaseController;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Services\Msg;
use Config;
use Auth;

abstract class Controller extends BaseController
{
    private $msg;

    use DispatchesJobs;

    public function __construct(){
        parent::__construct();
        $need_auth = Config::get('auth.need');

        $_arr = explode("\\",get_class($this));
        $class = strtolower(substr(array_pop($_arr),0,-10));

        if( !Auth::check() && $class != "access"){
            abort(302,"重定向到登录页面",["Location"=>"/Admin/Access/login"]);
        }
    }
}
