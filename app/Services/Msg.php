<?php 
namespace App\Services;
use Response;

class Msg{

	public $msg_arr;
	public $isAjax;
	public $default;

	public function __construct(Array $msg_arr = [],$isAjax = false ,$default=""){
		if(count($msg_arr) <= 0 ){
			return false;
		}
		$this->msg_arr = $msg_arr;
		$this->isAjax  = $isAjax;
		if(trim($default) == ""){
			$this->default = "系统忙，请稍后再试";	
		}else{
			$this->default = $default;
		}
	}

	public function send($sta,$data="",$redirect=""){
		
		if(isset($this->msg_arr[$sta])){
			$msg = $this->msg_arr[$sta];
		}else{
			$msg = $this->default;
		}

		$res = compact("sta","msg","data","redirect");
		
		return response()->json($res);
	}

	public function getRes($sta){
		if(isset($this->msg_arr[$sta])){
			$msg = $this->msg_arr[$sta];
		}else{
			$msg = $this->default;
		}
		$res = compact("sta","msg","data","redirect");
		
		return $res;		
	}

}

?>