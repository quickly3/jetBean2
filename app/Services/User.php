<?php
namespace App\Services;

use Session;

class User
{
    public static function isLogin(){
        return Session::has("user_info");
    }

    public static function userInfo(){
        return Session::get("user_info");
    }


}
?>