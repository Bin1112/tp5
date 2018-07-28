<?php 
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
class ArticleController extends CommonController{

	public function getContent(){
		if (request()->isAjax()) {
			// 1. 接受参数article_id
			$article_id = input('article_id');
			// 2. 获取内容 (获取content字段的值)
			$content = Article::where(['article_id'=>$article_id])->value('content');
			// 3. 返回json格式数据
			return json(['content'=>$content]);
		}
	}


	public function del(){
		$article_id = input('article_id');
		$oldObj = Article::get($article_id);
		// 删除原图的路径和缩略图
		if ($oldObj['ori_img']) {
			unlink("./upload/".$oldObj['ori_img']);
			unlink("./upload/".$oldObj['thumb_img']);
		}
		if ($oldObj->delete()) {
			$this->success('删除成功',url('/admin/article/index'));
		}else{
			$this->error('删除失败');
		}
	}

	public function upd(){
		$artModel = new Article();
		if (request()->isPost() ) {
			// 1.接收post参数
			$postData = input('post.');
			// 2.验证器验证
			$result = $this->validate($postData,'Article.upd',[],true);
			if ($result!==true) {
				$this->error( implode(',',$result) );
			}
			// 验证成功之后, 进行文件上传和缩略图的缩放
			$path = $this->uploadImg('img');
			if ($path) {
				// 删除原来文章的原因和缩略图
				// 获取到图片的原图路径和缩略图路径
				$oldData = $artModel->find($postData['article_id']);
				if ($oldData['ori_img']) {
					@unlink('./upload/'.$oldData['ori_img']);
					@unlink('./upload/'.$oldData['thumb_img']);
				}
				$postData['ori_img'] = $path['ori_img'];
				$postData['thumb_img'] = $path['thumb_img'];
			}
			// 3.编辑入库
			if ($artModel->update($postData)) {
				$this->success('编辑成功',url('admin/article/index'));
			}else{
				$this->error('编辑失败');
			}
		}

		$catModel = new Category();
		$article_id = input('article_id');
		// 取出当前文章的数据, 分配到模板中
		$art = $artModel->find($article_id);
		// 取出所有的分类 (无限极)
		$cats = $catModel->getSonsCat( $catModel->select() );
		return $this->fetch('',['art'=>$art,'cats'=>$cats]);
	}


	public function index(){
		// 获取所有文章
		$num = 3;
		$page = input('page')?: 1;
		$arts = Article::alias('a')
					->field('a.*,c.cat_name')
					->join('tp_category c','a.cat_id = c.cat_id','left')
					->order('a.article_id desc')
					->paginate($num);
					// halt($arts);
					return $this->fetch('',['arts'=>$arts, 'page'=>$page, 'num'=>$num]);
	}

	public function add(){
		// 获取所有的分类 (无限极处理)
		$catModel = new Category();
		$artModel = new Article();
		// 1. 判断是否是post请求
		if (request()->isPost()) {
			// 2. 接收post参数
			$postData = input('post.');
			// 3. 单独验证器验证
			$result = $this->validate($postData,"Article.add",[],true);
			if ($result !== true) {
				// 提示错误信息
				$this->error( implode(',', $result) );
			}
			// 验证成功之后, 进行文件上传和缩略图的缩放
			$path = $this->uploadImg('img');
			if ($path) {
				$postdata['ori_img'] = $path['ori_img'];
				$postData['thumb_img'] = $path['thumb_img'];
			}
			
			// 4. 判断是否入库成功
			if ($artModel->save($postData)) {
				$this->success('入库成功',url('admin/article/index'));
			}else{
				$this->error('入库失败');
			}
		}

		$cats = $catModel->getSonsCat( $catModel->select() );
		return $this->fetch('',['cats'=>$cats]);
	}
}
