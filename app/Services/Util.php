<?php 
namespace App\Services;

use Response;
use Config;


class Util
{
	public static function blog2resource($stream){
		if($tmp_img = base64toFile($stream)){
			$blog_img = env('DOCUMENT_ROOT').Config::get('path.blog');

			if(!is_dir($blog_img)){
				mkdirs($blog_img);
			}

			$filename = $blog_img."/".basename($tmp_img['rela_path']);
			if(!copy($tmp_img['real_path'], $filename)){
				return -2004;
			}
			$file_id = Model('Resource')->input($tmp_img)->toArray();	
			

			if(!$file_id){
				return -2003;
			}else{
				$file_id = $file_id['id'];
			}
		}else{
			return -2003;
		}

		return $file_id;
	}


}
?>