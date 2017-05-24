<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Request;
use Session;
use Redirect;


class IndexController extends Controller{

	public function index(){
		return view('admin.index.index', ['title'=>"CoG | Tell your world"]);
	}


}