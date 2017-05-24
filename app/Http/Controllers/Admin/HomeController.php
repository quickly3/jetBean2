<?php
namespace App\Http\Controllers\Home;

use \App\Http\Controllers\Controller;
use Request;

class HomeController extends Controller{

    public function index($id = 0){

        return View("home.blog.index");
    }


    public function page(){
        $perPage = 10;
        $blog_m   = Model("Blog");
        $blogList = $blog_m->getBlogList($perPage);
        $pager = $blogList->toJson();
        return $pager;
    }


    public function blogList(){
        $blog_m   = Model("Blog");
        $blogList = $blog_m->getBlogList(["_id","title","summary","thumbnailUrl"]);
        return response()->json($blogList);
    }

}