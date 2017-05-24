<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so we do not have to manually load any of
| our application's PHP classes. It just feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/**
*
* 加载快捷函数
*
*
**/
$fileArr = array(
	__DIR__.'/../app/Helper/common.php'
);

foreach($fileArr as $key => $value) {
	if(file_exists($value)) {
		require $value;
	}
}