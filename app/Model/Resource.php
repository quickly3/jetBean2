<?php

namespace App\Model;


use Session;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = "resources";

    protected $fillable = array('id','user_id','real_path','rela_path','type','filename');


    public function input($file){
        $data = $file;
        $data['filename'] = basename($file['real_path']);
        $data['user_id'] = $data['user_id'] = Session::get("user_info.id",0);

        return $this->create($data);
    }

    public function res_save($data){
        if(isset($data['id'])){
            $m = $this->find($data['id']);
            unset($data['id']);
            $m->fill($data);
        }else{
            $m = new Resource($data);
        }
        $m->save();
        return $m;
    }

}
    