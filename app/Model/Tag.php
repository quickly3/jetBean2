<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tags";

    protected $fillable = array('id','name','created_at','update_at');

    public function ExistedTags($tags){
        return $this->select("name")->whereIn('name',$tags)->get();
    }

    public function genTags($tags){
        $data = [];


        foreach($tags as $i){
            $data[] = ["name"=>$i,'created_at'=>new \DateTime];
        }

        return $this->insert($data);
    }

    public function getTags($bid){

        return $this->select("a.name")
            ->from("b_ts as b")
            ->join("tags as a","a.id","=","b.tag_id")
            ->where("b.blog_id","=", $bid)
            ->distinct()
            ->get();
    }

    public function getIds($tags){
        $ret = $this->select("id")->whereIn('name',$tags)->get();
        $ids = [];

        if($ret->count() > 0){
            foreach($ret as $i){
                $ids[] = $i->id;
            }
            return $ids;
        }
        return false;
    }

    public function getValid(){
        return $this
        ->select("a.id","a.name")
        ->from("tags as a")
        ->join("b_ts as b","b.tag_id","=","a.id")
        ->join("blogs as c","c.id","=","b.blog_id")
        ->distinct()
        ->get();
    }

}
