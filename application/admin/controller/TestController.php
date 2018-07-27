<?php 
// 定义当前所在的命名空间
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Category;
use app\admin\model\Article;
// 定义控制器名 (和文件名要一致)
class TestController extends Controller
{ 

	public function model(){
		echo 'dev';
		echo 'master';
		echo 'devdevdev';
		echo md5("123456".config('paasword_salt'));die;
	}
	// public function model(){
	// 	$catModel = new Category();
	// 	$data = $catModel
	// 			->field('t1.*,t2.cat_name as p_name')
	// 			->alias('t1')
	// 			->join('tp_category t2','t1.pid = t2.cat_id','left')
	// 			->select()
	// 			->toArray();
	// 		dump( $data );
	// }





	// public function model(){
	// 	// 需求: 联表查询查出文章的所属分类
	// 	$data = Db::name('article')
	// 			->field('t1.*,t2.cat_name as p_name')
	// 			->alias('t1')
	// 			->join('tp_category t2','t1.cat_id = t2.cat_id','left')
	// 			->select();
	// 		dump( $data );
	// }



	// public function model(){
	// 	$artModel = new Article();
	// 	$data = $artModel
	// 			->field('t1.*,t2.cat_name')
	// 			->alias('t1')
	// 			->join('tp_category t2','t1.cat_id = t2.cat_id','left')
	// 			->select()
	// 			->toArray();
	// 		dump($data);
	// }



	// public function model(){
	// 	$catModel = new Category();
	// 	$data = $catModel->limit(2,2)->select()->toArray();
	// 	dump($data);
	// }

	// public function model(){
	// 	$catModel = new Category();
	// 	// 取出cate_name字段, 根据pd进行分组, 求总数
	// 	$data = $catModel->field('cat_name,pid,count("cat_id")  count')->group('pid')->select()->toArray();

	// 	dump($data);
	// }



	// public function model(){
	// 	$catModel = new Category();
	// 	// 表达式查询条件
	// 	$data = $catModel->field('cat_name,cat_id')
	// 	->order('cat_id desc')
	// 	->where('cat_id', '>', '2')
	// 	->where('pid','=','1')
	// 	->buildSql();

	// 	dump($data);
	// }



	// public function model(){
	// 	$catModel = new Category();
	// 	// 表达式查询条件
	// 	$data = $catModel->field('cat_name,cat_id')
	// 	->order('cat_id desc')
	// 	->where('cat_id', '>', '2')
	// 	->where('pid','=','1')
	// 	->select();

	// 	dump($data);
	// }




	// public function model(){
	// 	$cateModel = new Category();
	// 	// $data = $cateModel->all();
	// 	$data = Category::get(2)->toArray();

	// 	dump( $data );

	// }



	// public function model(){
	// 	// $cateModel = new Category();
	// 	// $data = $cateModel->all();
	// 	$data = Category::where('cat_id = 2')->select();

	// 	dump( $data );

	// }



	// public function model(){
	// 	// $cateModel = new Category();
	// 	// $category = $cateModel->where('cat_id = 2')->find();
	// 	$category = Category::get(function($query){
	// 		$query->where('cat_id = 2');
	// 	});

	// 	dump( $category->cat_id );
	// 	dump( $category->cat_name );
	// 	dump( $category['cat_id'] );
	// 	dump( $category['cat_name'] );

	// }



	// public function model(){
	// 	// 实例化模型
	// 	$category = Category::get(1);
	// 	dump( $category->delete() );

	// }



	// public function model(){
	// 	// 实例化模型
	// 	dump( Category::destroy(9) ); // 
	// 	dump( Category::destroy('6,7,8') );

	// }



	// public function model(){
	// 	// 实例化模型
	// 	$cateModel = new Category();
	// 	$data = [
	// 		'cat_id' => '9',
	// 		'cat_name' => '溜溜球',
	// 		'pid' => '1',
	// 	];
	// 	dump( $cateModel->update($data) );
	
	// }



	// public function model(){
	// 	// 实例化模型
	// 	$cateModel = new Category();
	// 	$data = [
	// 		'cat_name' => '网球',
	// 		'fjiofjas' => 'hisahsa',
	// 		'pid' => '1'
		

	// 	];
	// 	dump( $cateModel->allowField(true)->save($data) );
	// 	// 获取入库后的字段值
	// 	// 模型对象-> 字段名
	// 	dump($cateModel->cat_id);
	
	// }


	// public function model(){
	// 	// 实例化模型
	// 	$cateModel = new Category();
	// 	$data = [
	// 		['cat_name' => '乒乓球','pid' => '1'],
	// 		['cat_name' => '台球','pid' => '1'],
	// 		['cat_name' => '铅球','pid' => '1']

	// 	];
	// 	dump( $cateModel->saveAll($data) );
	
	// }



	// public function model(){
	// 	// 实例化模型
	// 	$cateModel = new Category();
	// 	$data = [
	// 		'cat_name' => '乒乓球',
	// 		'pid' => '1'
	// 	];
	// 	dump( $cateModel->save($data) );
	// 	// 获取入库后的字段值
	// 	// 模型对象->字段名
	// 	dump( $cateModel->cat_id );
	// }



	// public function index(){
	// 	// 方式一: 需要引入模型
	// 	// 静态调用
	// 	// $data = Category::get(1);
	// 	// 实例化模型
	// 	$cate = new Category();
	// 	$data = $cate->get(1); // 返回当前的数据对象
	// 	dump($data);
		
	// }


	// public function index(){
	// 	// 方式二: 使用助手函数model
	// 	$cate = model('Category');
	// 	$data = $cate->get(1); // 返回当前的数据对象
	// 	dump($data);
		
	// }



	// public function index(){

	// 	dump( Db::table('tp_category')->select());
	// 	// return $this->fetch();
	// }
	public function index2(Request $request){
		// $request = Request::instance();
		// $request = request();
		dump($request->domain());  // 获取当前域名
		dump($request->module());  // 获取当前模板名称
		dump($request->controller());  // 获取当前控制器
		dump($request->action());  // 获取当前操作方法名
		dump($request->isAjax());  // 判断是否是ajax请求
		dump($request->isPost());  // 判断是否是post请求
		dump($request->isGet());   // 判断是否是get请求
	}

	public function index3(){

		dump( input('username','','strip_tags,strtolower') ); // 先去除标记, 再转化为小写
		dump( input('email') );
		dump( input('ids/a') ); // 接收数组参数/a
		dump( input('post.') );
	}
}
