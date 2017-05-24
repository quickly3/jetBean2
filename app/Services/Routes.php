<?php

namespace App\Services;

use Route;
use Config;
/**
 * 系统路由
 * 
 * 注：大部分的路由及控制器所执行的动作来说，
 * 
 * 你需要返回完整的 Illuminate\Http\Response 实例或是一个视图
 *
 * @author Bean quickly3@sohu.com
 */
class Routes
{
    private $adminDomain;

    private $wwwDomain;

    private $noPreDomain;

    /**
     * 初始化，取得配置
     *
     * @access public
     */
    public function __construct()
    {
     
        $host = Config::get('app.url');
        $ip   = Config::get('app.ip');

        $this->adminDomain = $host."/Admin";
        $this->wwwDomain = $host;
        $this->noPreDomain = $host;
        $this->IP = $ip;

    }


    /**
     * 博客通用路由
     * 
     * 这里必须要返回一个Illuminate\Http\Response 实例而非一个视图
     * 
     * 原因是因为csrf中需要响应的必须为一个response
     *
     * @access public
     */
    public function www()
    {

        Route::get('/', function(){
            $class = 'App\\Http\\Controllers\\Home\\BlogController';
            $classObject = new $class();
            return $classObject->index();
        });

        Route::get('/blog.html', function(){
            $class = 'App\\Http\\Controllers\\Home\\BlogController';
            $classObject = new $class();
            return $classObject->index();
        });

        Route::get('/Adm', function(){
            $class = 'App\\Http\\Controllers\\Admin\\AccessController';
            $classObject = new $class();
            return $classObject->login();
        });


        Route::group([], function ()
        {
            
            Route::any('{module}/{ctrl}/{action}', function ($module,$ctrl,$action) {
                $expected = ["views","api"];
                $ctrl = ucfirst($ctrl);
                $module = ucfirst($module);

                $class = 'App\\Http\\Controllers\\'.$module.'\\'.$ctrl.'Controller';

                if(class_exists($class))
                {
                    $classObject = new $class();
                    if(method_exists($classObject, $action)) return call_user_func(array($classObject, $action));
                }
                return abort(404);
            });

        });
        return $this;
    }

    public function mobile(){
        Route::group(['domain' => 'mob.test2.com'], function () {
            Route::get('/', function () {
                return "123";
            });
        });
        return $this;     
    }

}


