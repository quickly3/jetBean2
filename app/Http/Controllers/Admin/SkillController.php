<?php

namespace App\Http\Controllers\Admin\Foundation;

use Request;

use App\Http\Controllers\Admin\Controller;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $user_m = Model("User");
        $user_list = $user_m->get_users();
        $title  = "user_list";

        $page =  $user_list->setPath('')->appends(Request::all())->render();
        
        $res = compact("user_list","title","page");

        return view('admin.foundation.user.index', $res);
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
            $data["pwd"]  = trim(md5(Request::input("pwd")));


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
}
