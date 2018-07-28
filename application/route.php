<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];

// think从thinkphp/library/目录下面找起
use think\Route;
// 定义路由规则
// 测试路由
Route::get('admin/test/index', 'admin/test/index');
Route::get('admin/test/index2', 'admin/test/index2');
Route::any('admin/test/index3', 'admin/test/index3');


// 定义网站根目录路由
Route::get('/', 'admin/index/index');
// 后台首页路由
Route::get('top', 'admin/index/top');
Route::get('left', 'admin/index/left');
Route::get('main', 'admin/index/main');
// 后台登录页路由
Route::post('login', 'admin/public/login');
Route::get('login', 'admin/public/login');
Route::get('logout', 'admin/public/logout');

// 后台路由组
Route::group('admin', function() {
	// 分类管理相关路由
   	Route::get('category/add', 'admin/category/add');
   	Route::post('category/add', 'admin/category/add');
   	Route::get('category/index', 'admin/category/index');
   	Route::get('category/upd', 'admin/category/upd');
	Route::post('category/upd', 'admin/category/upd');
   	Route::get('category/ajaxDel', 'admin/category/ajaxDel');
   	// 文章数据操作相关路由
      Route::get('article/getContent', 'admin/article/getContent'); // 查看文章内容的路由
      Route::get('article/del', 'admin/article/del'); // 文章删除的路由
      Route::post('article/upd', 'admin/article/upd'); // 文章编辑实现入库的路由
      Route::get('article/upd', 'admin/article/upd'); // 文章编辑回显到视图的路由
      Route::get('article/index', 'admin/article/index'); // 展示文章列表使徒的路由
   	Route::get('article/add', 'admin/article/add'); // 展示添加文章的视图的路由
   	Route::post('article/add', 'admin/article/add'); // 完成添加文章入库的路由

});




