<?php 
// 定义当前类所在的命名空间
namespace app\admin\controller;
// 引入父类控制器
use think\Controller;
use think\Validate;
use app\admin\model\User;
class PublicController extends Controller
{
	public function login(){
		// 判断是否是post请求
		if (request()->isPost()) {
			// 接受参数
			$postData = input('post.');
			// 验证数据是否合法 (验证器去验证)
			// 1. 验证规则
			$rule = [
				// 表单name名称 => 验证规则 (多个用竖线隔开)
				'username' => 'require|length:4,8',
				'password' => 'require',
				'captcha'  => 'require|captcha'
			];
			// 2. 验证的错误信息
			$message = [
				// 表单name名称, 规则名 => '响应提示错误信息'
				'username.require' => '用户名必填',
				'username.length' => '用户名长度在4-8之间',
				'password.require' => '密码必填',
				'captcha.require' => '验证码必填',
				'captcha.captcha' => '验证码错误'
			];
			// 3. 实例化验证器对象, 开始验证
			$validate = new Validate($rule,$message);
			// 4. 判断是否验证成功
			$result = $validate->batch()->check($postData);
			// 成功  $result true    失败  $result false
			if (!$result) {
				// 提示错误信息
				$this->error( implode(',', $validate->getError()) );
			}

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