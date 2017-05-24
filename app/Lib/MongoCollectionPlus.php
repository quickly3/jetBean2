<?php 
namespace App\Lib;	

class MongoCollectionPlus extends \MongoCollection{

	public function __coustruct__($db, $table){
	
	}

	public function findPlus($a=[],$b=[]){

		$rs = $this->find($a,$b);

		if(!$rs){
			return false;
		}
		$filtered = [];
		
		foreach ($rs as $k => $v) {
			$v["created"] = $v["_id"]->getTimestamp();
			$v["_id"] = $v["_id"]->__toString();  
			$filtered[] = $v;	
		}
		return $filtered;
	}

	public function findOnePlus($a){

		if(isset($a['_id'])){
			if(!\MongoId::isValid($a['_id'])){
				return false;
			}

			$a['_id'] = new \MongoId($a['_id']);			
		}

		$rs = $this->findOne($a);
		
		if(!$rs){
			return false;
		}

		if(isset($a['_id'])){
			$rs["created"] = $rs["_id"]->getTimestamp();
			$rs["_id"]     = $rs["_id"]->__toString();  			
		}

		return $rs;
	}

	public function insertPlus($data){
		$rs = $this->insert($data);
		return $rs;
	}




}

?>