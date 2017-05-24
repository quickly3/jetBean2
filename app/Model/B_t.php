<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class B_t extends Model
{
    protected $table = "b_ts";

    protected $fillable = array('id','blog_id','tag_id','created_at','updated_at');

    public function mutiSave($bid,$tids){
        $data=[];
        $this->where(['blog_id' => $bid])->delete();
        foreach($tids as $i){
            $data[] = ['blog_id' => $bid,'tag_id'=>$i,'created_at'=>new \DateTime];
        }

        return $this->insert($data);
    }
}
