<?php
namespace App\Services;
use Request;


class Upload{

    public static function input2Res($name="" , $distDir="upload/tmp"){
        if(trim($name) == "") return false;

        $file = Request::file($name);

        if($file){
            $oriExt =  $file->getClientOriginalExtension();
            $inner_name = self::genInnerName($oriExt);
	
            $base = base_path()."/public/";
	        $move = $file->move($base.$distDir, $inner_name);

            if(!$move) return false;

            $data = [
                "user_id"  => User::userInfo()['id'],
                "filename" => $inner_name,
                "type"     => $oriExt,
                "real_path" =>base_path()."/".$distDir."/".$inner_name,
                "rela_path" => "/".$distDir."/".$inner_name
            ];

            $savedId = Model("Resource")->res_save($data);

            if(!$savedId) return false;

            return $savedId;

        }else{
            return false;
        }
    }




    public static function genInnerName($type=""){
        if(trim($type) != ""){
            $name = time()."_".mt_rand(1,100).".".$type;;
        }else{
            $name = time()."_".mt_rand(1,100);
        }
        return $name;
    }

}

?>
