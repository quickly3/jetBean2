<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Request;
use Db;

class Blog extends Model
{
    protected $table = "blogs";

    protected $fillable = array('id','title','category','summary', 'content', 'main_img','thumbnailUrl','view','created_at','user_id');


	// public $timestamps = false; 

    public function getBlogList($perPage = 15){

        $ret = $this->select(["blogs.id","title","users.name as author","summary","blogs.created_at"])
               ->leftJoin('users','blogs.user_id','=','users.id')
               ->orderBy("blogs.created_at",'desc')
               ->paginate($perPage);



    	return $ret;
    }

    public function indexBlogs($perPage = 5,$cate,$tag){
        $query = $this->select(["blogs.id","title","users.name as author","summary","blogs.created_at","b.rela_path as img" ,"view"])
               ->leftJoin('users','blogs.user_id','=','users.id')
               ->leftJoin('resources as b',"blogs.main_img","=","b.id");

        if($cate > 0){
            $query->where("category","=",$cate);
        }

        if($tag > 0){
            $query->join('b_ts as c', function ($join) use ($tag) {
                $join->on('c.blog_id', '=', 'blogs.id')
                     ->where('c.tag_id', '=', $tag);
            });
        }

        return $query->orderBy("blogs.created_at",'desc')
                     ->paginate($perPage);

    }

    public function blogInfo($_id){

        $ret = $this->select(["blogs.id","blogs.category","title","users.name as author","summary","content","blogs.created_at","b.rela_path as img","view"])
            ->leftJoin('users','blogs.user_id','=','users.id')
            ->leftJoin('resources as b',"blogs.main_img","=","b.id")
            ->find($_id);

        if($ret){
            $tags_c = Model("Tag")->getTags($_id);
            $tags_name = [];
            if($tags_c){
                foreach($tags_c as $i){
                    $tags_name[] = $i->name;
                }
            }
            $tags_name = implode(",",$tags_name);
            $ret->tags = $tags_name;

            return $ret;
        }else{
            return false;
        }

    }

    public function viewCntAdd($obj){

        unset($obj->tags);
        $obj->fill(['view' => $obj->view+1]);
        return $obj->save();
    }

    public function remove($id){
    	return $this->where(['id' => $id]) -> delete();
    }

    public function blog_save($data){

        if(trim($data['tags']) != ""){
            $_tags = explode(",",$data['tags']);
            $tag_m = new Tag();

            $ExistedTags = $tag_m->ExistedTags($_tags);

            $ExistedTagsArr = [];
            $new_tags = [];
            if($ExistedTags->count()>0){
                foreach($ExistedTags as $i){
                    $ExistedTagsArr[] = $i['name'];
                }
            }
            $new_tags = array_diff($_tags,$ExistedTagsArr);

            if(count($new_tags) > 0){

                $insert = $tag_m->genTags($new_tags);
            }

            $ids  = $tag_m->getIds($_tags);

        }
        unset($data['tags']);

        if(isset($data['id'])){
            $m = $this->find($data['id']);
            unset($data['id']);
            $m->fill($data);
        }else{

            $m = new Blog($data);
        }
        $ret = $m->save();

        if($ret && isset($ids) ){
            $blog_id = $m->id;
            $b_t_m = New B_t;
            $in2 = $b_t_m->mutiSave($blog_id,$ids);
        }

    	return $ret;
    }

    public function lastBlog($cate,$tag){
            $query = $this->select(["blogs.id","title","users.name as author","summary","content","blogs.created_at","b.rela_path as img" ,"view"])
            ->leftJoin('users','blogs.user_id','=','users.id')
            ->leftJoin('resources as b',"blogs.main_img","=","b.id");

            if($cate > 0){
                $query->where("category","=",$cate);
            }

            if($tag > 0){
                $query->join('b_ts as c', function ($join) use ($tag) {
                    $join->on('c.blog_id', '=', 'blogs.id')
                         ->where('c.tag_id', '=', $tag);
                });
            }

            return $query->orderBy("id","desc")
            ->limit(1)
            ->first();
	    
	}

    public function getLastBlog($cnt){

        return $this->select(["blogs.id","title","users.name as author","summary","content","blogs.created_at","b.rela_path as img"])
            ->leftJoin('users','blogs.user_id','=','users.id')
            ->leftJoin('resources as b',"blogs.main_img","=","b.id")
            ->first();
    }

    public function acient($cnt = 3){
        return $this->select("blogs.id","title","summary","b.rela_path as img")
        ->leftJoin('resources as b',"blogs.main_img","=","b.id")
        ->orderBy("blogs.created_at")->limit($cnt)->get();
    }

    public function recent($cnt = 4){
        return $this->select("blogs.id","title","summary","b.rela_path as img")
        ->leftJoin('resources as b',"blogs.main_img","=","b.id")
        ->orderBy("blogs.created_at","desc")->limit($cnt)->get();
    }
}
