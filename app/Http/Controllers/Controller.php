<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Services\Msg;
use Config;
use Redirect;
use Request;
use Session;
use View;
use URL;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $msg;


    public function __construct()
    {
        $msg_arr = Config::get('msg');
        $this->msg = new Msg($msg_arr);
    }

    private function ajaxReturn($sta,$msg="",$data=""){
    	$res = compact("sta","msg","data");
    	echo json_encode($res);die();
    }

    public function send($sta,$data="",$redirect=""){

    	return $this->msg->send($sta,$data,$redirect);
    }

    public function getRes($sta){
        return $this->msg->getRes($sta);
    }

    public function showMsg($rsCode,$url=""){
       
        $msg       = $this->msg->getRes($rsCode)['msg'];
        $rsCode      = $rsCode;
        $failed    = $rsCode < 0;

        $targetUrl = URL::previous();
        if(trim($url) != ""){
            $targetUrl = $url;
        }

        $title     = "Redirecting to {{$targetUrl}}";

        $res = compact("msg","failed","title","targetUrl","rsCode");

        $rs = View::make('admin.foundation.msg',$res);
        $render = $rs ->render();
        die($render);
    }
}
