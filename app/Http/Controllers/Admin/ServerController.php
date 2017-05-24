<?php 
namespace App\Http\Controllers\Admin\Foundation;

use App\Http\Controllers\Admin\Controller;
use App\Lib\UploadHandler;
use Request;

use Session;
use Redirect;


class ServerController extends Controller{

	public function FileUpload(){
        $upload_handler = new UploadHandler(["print_response"=>false]);

        $rep = $upload_handler->get_response();

        return Response()->json($rep);
	}

}