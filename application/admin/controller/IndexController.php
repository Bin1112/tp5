<?php 
// 定义当前类所在的命名空间
namespace app\admin\controller;
// 引入父类控制器
use think\Controller;
class IndexController extends CommonController
{
	public function index(){
		// 渲染出视图
		return $this->fetch();
	}
	public function top(){
		// 渲染出视图
		return $this->fetch();
	}
	public function left(){
		// 渲染出视图
		return $this->fetch();
	}
	public function main(){
		// 渲染出视图
		return $this->fetch();
	}
} 
