<?php 
namespace App\Http\Controllers\Admin;

use App\Services\User;
use \App\Services\Upload;
use Request;
use Validator;


class BlogController extends Controller{

	public function index(){

		return view('admin.blog.index', ['title'=>"CoG | Tell your world"]);
	}

	public function add(){
			
		$id = Request::input("id");
		$var['categories'] =  Model("Category")->get();

		$var['blogInfo'] = "";
		$var['header'] = "Add";
		$var['handleUrl'] = "addhandle";

		if($id){
			$blog_m = Model("blog");
			$var['blogInfo'] = $blog_m->blogInfo($id);
			$var['handleUrl'] = "addhandle?id={$id}";
		}

		return view('admin.blog.content', $var);
	}



	private function blog_init(){
		$data['title']        = Request::input("title");
		$data['summary']      = Request::input("summary");
		$data['content']      = Request::input("content");
		$data['main_img']     = Request::input("main_img");
		$data['category']     = Request::input("category");
		$data['tags']     	  = Request::input("tags");
		$data['created_at']   = Request::input("created_at");
		$data['created_at']   = date("Y-m-d H:i:s",strtotime($data['created_at']));
		$data['thumbnailUrl'] = "";
		$data['thumbnailUrl'] = '';
		$data['main_img'] = 0;
		$data['user_id'] = User::userInfo()['id'];

		$img_id = Request::input("cate_img");
		
		if($img_id >0){
			$data['main_img'] = $img_id; 
		}else{
		$up = Upload::input2Res("main_img","upload/blog");
			if($up){
				$data['main_img'] = $up->id;
			}
			if($data['thumbnailUrl']){
				$data['thumbnailUrl'] = Request::input("thumbnailUrl");
			}			
		}



		return $data;
	}


	public function addhandle(){

		$sta = 1000;
		$data = $this->blog_init();

		$id = Request::input("id");
		

		if($id){
			if($data['main_img'] == 0){
				unset($data['main_img']);
			}
			$data['id']      = $id;
		}

		$blog_m = Model("Blog");	

		$invalid = $this->blogCheck($data);
		
		if($invalid){
			
			$json_data['invalid'] = $invalid;

			$this->showMsg(-2001);
		}

		$rs = $blog_m->blog_save($data);

		
		if(!$rs){
			$sta = -1000;
		}

		$this->showMsg($sta,"/admin/blog/bloglist");
	}


	private function blogCheck($data){
		$rule = [
			"title"   => "required|max:50", 
			"summary" => "required|max:100",
			"content" => "required",
		];

		$validator = Validator::make($data,$rule);		

		if($validator->fails()){
			return json_decode(json_encode($validator->messages()),true);			
		}	

		return false;

	}

	public function bloglist(){

		$blog_m = Model("Blog");

		$blogList = $blog_m->getBlogList(12);

		$var = compact("blogList");

		return view('admin.blog.bloglist', $var);
	}

	public function delete(){

		if(!Request::input('id')){
			return $this->showMsg(-2001);
		}

		$id = (int)Request::input('id');

		$blog_m = Model("blog");

		$blogInfo = $blog_m->blogInfo($id);

		if(!$blogInfo){
			return $this->showMsg(-2002);
		}

		$rs = $blog_m->remove($id);

		if($rs){
			return $this->showMsg(2001,"/Admin/Blog/bloglist");
		}else{
			return $this->showMsg(-2003);
		}

	}

    public function addCate(){
        $cate = trim(Request::input("_cate"));

        $cate_m = Model('Category');
        $isExisted = $cate_m->where(['name' => $cate])->first();
        if($isExisted){
        	return $this->send(-20,"Cate already existed");
        }
        $cate_m->fill(["name"=>$cate,"order"=>0])->save();
        if(!$cate_m){
        	return $this->send(-1,"Sys error");
        }
        $data = $cate_m->toArray();
        return $this->send(1,$data);
    }


}
