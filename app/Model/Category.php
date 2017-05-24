<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = array('id','name','created_at','update_at','img_id');

    public function getValid(){
    	return $this
        ->select(DB::raw("a.id,a.name,count(1) as cnt"))
        ->from("categories as a")
        ->join("blogs as b","b.category","=","a.id")
        ->groupBy(["a.id","a.name"])
        ->get();
    }

    public function getCates(){
        return $this->select("a.id","a.name","b.rela_path as rela_path","a.img_id")
                    ->from("categories as a")
                    ->leftJoin("resources as b","a.img_id","=","b.id")
                    ->paginate();
    }

    public function getCate($id){
         return $this->select("a.id","a.name","b.rela_path as rela_path","a.img_id")
                    ->from("categories as a")
                    ->leftJoin("resources as b","a.img_id","=","b.id")
                    ->where("a.id","=",$id)
                    ->first();       
    }
}
