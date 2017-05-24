<?php
namespace App\Http\Controllers\Home;


use \App\Http\Controllers\Controller;
use Request;

class IndexController extends Controller{

    public function index($id = 0){

        $title = "CoG|Blogs";

//        $blog_m   = Model("Blog");
//
//        if($id !== 0){
//            $_blogInfo = $blog_m  -> blogInfo($id)->first();
//        }else{
//            $_blogInfo = $blog_m  -> lastBlog();
//        }
//
//        if(!$_blogInfo){
//            return abort(404);
//        }
//
//        $_blogInfo = $_blogInfo->toArray();
//
//
//        $perPage = 10;
//        $blog_m   = Model("Blog");
//        $blogList = $blog_m->indexBlogs($perPage);

        return View("home.index.index");
    }
}