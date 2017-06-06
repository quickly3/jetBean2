<?php
namespace App\Http\Controllers\Home;


use \App\Http\Controllers\Controller;
use Request;

class BlogController extends Controller{

    public function index(){

        $blog_m   = Model("Blog");

        $cate = (int)Request::input("cate");
        $tag = (int)Request::input("tag");

        if($id = Request::input("id")){
            $blogInfo = $blog_m ->blogInfo($id);
            $blog_m->viewCntAdd($blogInfo);
        }else{
            $blogInfo = $blog_m ->lastBlog($cate,$tag);
        }

        // dump($blogInfo->view);die();
        if(!$blogInfo){
            return abort(404);
        }

        $blogList = $blog_m->indexBlogs(8,$cate,$tag);


        $categories = Model("Category")->getValid();
        $tags = Model("Tag")->getValid();
        $curr_cate = "";
        $curr_tag = "";
        if($cate > 0){
            foreach ($categories as $i) {
                if($i->id == $cate){
                    $curr_cate = $i;        
                }
            }         
        }
        if($tag > 0){
            foreach ($tags as $i) {
                if($i->id == $tag){
                    $curr_tag = $i;        
                }
            }         
        }       
        
        $blogCnt = $blog_m->count();
        $popular = $blog_m->acient(3);
        $recent = $blog_m->recent(4);

        $res = compact("blogInfo","blogList","categories","tags","popular","recent","blogCnt","curr_cate","curr_tag");
        // dump($categories->get(0)->id);die();
        return json_encode($res);
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

    public function statistics(){
        
        $stas = Model("Blog")->select("id","title","view")->orderBy("view","desc")->limit(10)->get()->toJson();
        // dump($stas);die();
        $var = compact("stas");
        return view("home.blog.statistics",$var);
    }

}
