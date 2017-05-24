<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use \App\Services\Upload;
use Request;
use Session;
use Redirect;
use DB;

class CateController extends Controller{

    public function index(){

    	$var = [];
        $list = Model("category")->getCates();
	
        $var['tile'] = "Category Management";
        $var['list'] = $list;

        
        return view('admin.cate.index', $var);
    }

    public function addCate(){
    	$data['name'] = trim(Request::input("name"));
    	$data['id'] = trim(Request::input("id"));
        if(Request::input("img_id")){
            $data['img_id'] = trim(Request::input("img_id"));
        }

    	$data['order'] = 0;

    	if($data['id'] == 0){
    		unset($data['id']);
    	}
    	$up = Upload::input2Res("img","upload/cate");

    	if(!isset($data['id']) && !$up){
    		$this->showMsg("请上传一张图片","/admin/cate/index");
    	}
        if($up){
            $data['img_id'] = $up->id;    
        }
    	
        $cate_m = Model('Category');

        if(isset($data['id'])){
            $isExisted = $cate_m->where('name', $data['name'])->where("id","!=",$data['id'])->first();
        }else{
            $isExisted = $cate_m->where(['name' => $data['name']])->first();
        }

        if($isExisted){
    		$this->showMsg("同名分类已经存在","/admin/cate/index");
        }
        if(isset($data['id'])){
            $cate_m->where("id",$data['id'])->update($data);
        }else{
            $cate_m->fill($data)->save();

        }
        
        if(!$cate_m){
        	$this->showMsg(-1000,"/admin/cate/index");
        }

        $this->showMsg(2002,"/admin/cate/index");
    }

    public function dropCate(){

        $id = trim(Request::input("id"));
        if(!$id){
            return $this->send(-2001);
        }

        $cate_m = Model('Category');

        DB::beginTransaction();

        $info = $cate_m->find($id);

        // if($info){
        //     $rs0 = Model("Resource")->where("id","=",$info->img_id)->delete();
        // }

        $rs1 = $cate_m->where("id","=",$id)->delete();
        // DB::rollback();
        DB::commit();
        
        if($rs1){
            $code = 2001;
        }else{
            $code = -2003;
        }

        return $this->send($code);
    }

    public function cateImg(){
        $id = trim(Request::input("id"));
        if(!$id){
            return $this->send(-2001);
        }
        $cate_m = Model("Category");
        $info = $cate_m->getCate($id)->toArray();
        if($info){
            return $this->send(1000,$info); 
        }else{
            return $this->send(-1000);
        }

    }
}

