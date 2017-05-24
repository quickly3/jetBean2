<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use \App\Services\Upload;
use Request;
use Session;
use Redirect;
use DB;

class SerieController extends Controller{

    public function index(){

    	$var = [];
        $list = Model("serie")->getSeries();
	
        $var['tile'] = "Category Management";
        $var['list'] = $list;

        return view('admin.series.index', $var);
    }

    public function addSerie(){

    	$data['name'] = trim(Request::input("name"));
    	$data['id'] = trim(Request::input("id"));

    	if($data['id'] == 0){
    		unset($data['id']);
    	}

    	$up = Upload::input2Res("image","upload/serie");
    	
    	if(!isset($data['id']) && !$up){
    		$this->showMsg("请上传一张图片","/admin/cate/index");
    	}
        if($up){
            $data['image'] = $up->id;    
        }	

        $serie_m = Model("Serie");

		if(isset($data['id'])){
            $isExisted = $serie_m->where('name', $data['name'])->where("id","!=",$data['id'])->first();
        }else{
            $isExisted = $serie_m->where(['name' => $data['name']])->first();
        }

        if($isExisted){
    		$this->showMsg("同名系列已经存在","/admin/serie/index");
        }

        if(isset($data['id'])){
            $serie_m->where("id",$data['id'])->update($data);
        }else{
            $serie_m->fill($data)->save();

        }
        
        if(!$serie_m){
        	$this->showMsg(-1000,"/admin/serie/index");
        }

        $this->showMsg(2002,"/admin/serie/index");

    }

    public function books(){
    	$id =  (int)trim(Request::input("id"));
    	if($id <1){
        	$this->showMsg(-1000,"/admin/serie/index");
    	}

    	$var = [];

    	$serieInfo = Model("Serie")->find($id);
    	$blogs = Model("Serie")->getBooks($id);

    	$var["blogs"] = $blogs;
    	$var["serieInfo"] = $serieInfo;

    	return view("admin.series.books",$var);

    }

}

