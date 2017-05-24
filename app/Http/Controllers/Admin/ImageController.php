<?php
namespace App\Http\Controllers\Admin;

use App\Services\User;
use \App\Services\Upload;
use Request;
use Validator;


class ImageController extends Controller{

    public function index(){


        $list = Model("resource")->orderBy("id","desc")->paginate(20);

        $var = compact("list");

        return view('admin.image.index', $var);
    }

    public function upload_img(){

    	$up = Upload::input2Res("img","upload/tmp");

    	if(!$up){
    		$this->showMsg("上传失败","/admin/image/index");
    	}
    	$this->showMsg("上传成功","/admin/image/index");
    	
    }
}
