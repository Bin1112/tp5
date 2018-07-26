<?php 
// 定义当前类所在的命名空间
namespace app\admin\controller;
// 引入父类控制器
use think\Controller;
use app\admin\model\User;
class PublicController extends Controller
{
	public function login(){
		// 判断是否是post请求
		if (request()->isPost()) {
			// 接受参数
			$postData = input('post.');
			// 验证数据是否合法 (验证器去验证)
			// 调用模型的方法checkUser, 检测用户名和密码是否匹配
			$userModel = new User();
			$flag = $userModel->checkUser($postData['username'],$postData['password']);
			if ($flag) {
				// 直接重定向后台首页
				$this->redirect('admin/index/index');
			}else{
				// 提示用户用户名或密码错误
				$this->error('用户名或密码有误');
			}
		}
		return $this->fetch();
	}
	public function logout(){
		// 清除session信息
		session(null); // 清除当前用户登录的所有的session信息
		$this->redirect('/login');
	}
}