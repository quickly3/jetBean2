<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Serie extends Model
{
    protected $table = "series";

    protected $fillable = array('id','name','created_at','update_at','image');

    public function getValid(){
    	return $this
    	->select(DB::raw("a.id,a.name,count(1) as cnt"))
    	->from("categories as a")
    	->join("blogs as b","b.category","=","a.id")
    	->groupBy("a.id")
    	->get();
    }

    public function getSeries(){
        return $this->select("a.id","a.name","b.rela_path as rela_path","a.image")
                    ->from("series as a")
                    ->leftJoin("resources as b","a.image","=","b.id")
                    ->paginate();
    }

    public function getBooks($id){
        $serieInfo = Model("Serie")->find($id);

        if(trim($serieInfo['b_ids']) == ""){
            return false;
        }
           
        $serieInfo['b_ids'] = explode(",",$serieInfo['b_ids']);
        
        return Model("Blog")->whereIn("id",$serieInfo['b_ids'])->paginate();;

    }
}
