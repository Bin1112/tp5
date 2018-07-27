<?php 
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
use think\Validate;
class CategoryController extends CommonController{

	public function ajaxDel(){
		if(request()->isAjax()){
			// 1. 接收参数cat_id
			$cat_id = input('cat_id');
			// 2. 判断分类下是否有子分类
			$where = [
				// 'pid' => ['=',$cat_id]
				'pid' => $cat_id
			];
			$result1 = Category::where($where)->find();
			if ($result1) {
				// 说明有子分类
				$response = ['code'=>-1,'message'=>'分类下有子分类, 无法删除'];
				return json($response);die; // 等价于 echo json_encode($response);die;
			}
			// 3. 判断分类下面是否有文章
			$result2 = Article::where(["cat_id"=>$cat_id])->find();
			if ($result2) {
				// 说明分类下有文章
				$response = ['code'=>-2,'message'=>'CategoryController.php分类下有文章,无法删除'];
				return json($response);die;
			}
			// 4. 只有上面两个条件都满足之后才可以删除分类
			if (Category::destroy($cat_id)) {
				$response = ['code'=>200,'message'=>'删除成功'];
				return json($response);die;

			}else{
				$response = ['code'=>-3,'message'=>'CategoryController.php分类下有文章,无法删除'];
				return json($response);die;
			}
		}
	}

	public function upd(){
		$catModel = new Category();
		// 判断是否是post请求
		if (request()->isPost()) {
			// 1. 接受参数
			$postData = input('post.');
			// 2.验证器验证( 后面单独抽离出来 )
			$result = $this->validate($postData,'Category.upd',[],true);

			// 3. 判断是否验证后成功
			if ($result !== true) {
				$this->error( implode(',', $result) );
			}
			// 4. 判断编辑入库是否成功
			if ( $catModel->update($postData) ) {
				$this->success('编辑成功', url('admin/category/index'));
			}else{
				$this->error('编辑失败');
			}
		}

		// 接受参数cat_id, 取出当前分类的数据
		$cat_id = input('cat_id');
		$catData = $catModel->find($cat_id);

		$data = $catModel->select();
		// 无限极分类处理
		$cats = $catModel->getSonsCat($data);
		return $this->fetch('',[
			'cats' => $cats,
			'catData' => $catData
		]);
	}

	public function add(){
		$catModel = new Category();

		// 判断是否是post请求
		if (request()->isPost()) {
		 	// 接收post参数
		 	$postData = input('post.');
		 	// 验证器验证数据 unique:category  unique:表名
		 	// $rule = [
		 	// 	'cat_name' => 'require|unique:category',
		 	// 	'pid' => 'require'
		 	// ];
		 	// $message = [
		 	// 	'cat_name.require' => '分类名称必填',
		 	// 	'cat_name.unique' => '分类名称重复',
		 	// 	'pid.require' => '必须选择一个分类'
		 	// ];
		 	// $validate = new Validate($rule, $message);
		 	// // 验证是否通过
		 	// $result = $validate->batch()->check($postData);

		 	// 使用单独的验证器进行验证
		 	$result = $this->validate($postData,'Category.add',[],true);
		 	// 成功返回 true 失败返回[err1,err2]
		 	if ($result !== true) {
		 		// 没有验证通过 $validate->getError()  ==> [err1,err2]
		 		$this->error( implode(',',$result));
		 	}
		 	// 验证通过之后进行数据入库
		 	if ($catModel->save($postData)) {
		 		$this->success('入库成功',url('admin/category/index'));
		 	}else{
		 		$this->error('入库失败');
		 	}
		 } 

		// 取出所有的分类, 分配到模板
		$data = $catModel->select()->toArray();
		// 对分类数据进行递归处理 (含有层级缩进关系)
		$cats = $catModel->getSonsCat($data);

		return $this->fetch('',['cats'=>$cats]);
	}

	public function index(){
		$catModel = new Category();
		$data = $catModel
				->field('t1.*,t2.cat_name p_name')
				->alias('t1')
				->join('tp_category t2','t1.pid=t2.cat_id','left')
				->select();
		// 进行无限极分类处理 (找子孙分类)
		$cats = $catModel->getSonsCat($data);
		// 输出模板视图
		return $this->fetch('',['cats'=>$cats]);
	}

}
