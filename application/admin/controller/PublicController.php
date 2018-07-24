<?php 
// 定义当前类所在的命名空间
namespace app\admin\controller;
// 引入父类控制器
use think\Controller;
class PublicController extends Controller
{
	public function login(){
		return $this->fetch();
	}
}