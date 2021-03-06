<?php

namespace App\Http\Controllers\Admin;

use Request;
use Session;
use Redirect;
use Log;
use App\Services\User;
use Illuminate\Support\Facades\Auth;


class AccessController extends Controller {

    public function signin(){

        $name = trim(Request::input("name"));
        $password  = trim(Request::input("pwd"));

        if (Auth::attempt(['name' => $name, 'password' => $password])) {
            return $this->send(1002,"","/");
        }else{
            return $this->send(-1002,"","/");
        }    
    }

    public function auth(){

        $msgCode = Session::has("user_info")?1003:-1003;
        $user_info = Session::get("user_info");
        return $this->send($msgCode,$user_info);
    }

    public function signout(){
        Auth::logout();
        abort(302,"退出登录",["Location"=>"/Adm"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function login()
    {
        if(Auth::check()){
            abort(302,"已经登录",["Location"=>"/Admin/Index/index"]);
        }
        $res = compact("user_list","title","page");

        return view('admin.access.index', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        if(strtolower(Request::method()) == "post"){
            $user_m = Model("User");

            $data["name"] = trim(Request::input("user"));
            $data["password"]  = bcrypt(trim(md5(Request::input("password"))));

            if($user_info = $user_m->userInfo(['name' => $data['name'] ])){
                $rsCode = -1001;
                $msg = $this->showMsg($rsCode);
            
            }


            $rs = $user_m->insert_user($data);   

            $rsCode = $rs?1001:-1000;

            // dump($rs);
            $msg = $this->showMsg($rsCode);   
        }

       return view('admin.foundation.user.create', ['title'=>"CoG | Tell your world"]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function test(){
        // abort(503);
        // Log::info("test log");
        // $o = new \monolog\Monolog\logger;
    }
}
