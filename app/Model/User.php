<?php

namespace App\Model;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table="users";
	
	public $timestamps = false;

    protected $fillable = array('id','name', 'pwd','image','email');

    public function userInfo($where){

    	$rs = $this->select(["id","name"])->where($where)->first();

    	return $rs;
    }


    public function get_users(){
    	
    	return $this->select(["id","name"])->paginate(15);
    }

    public function insert_user($data){
    	$data['created'] = time();

    	return $this->save($data);
    }
}
