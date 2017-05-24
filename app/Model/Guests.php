<?php

namespace App\Model;


use Session;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = "guests";

    protected $fillable = array('id','name', 'pwd','image','email');

    // public function 


}
    