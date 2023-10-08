<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class user_news extends controller{
	private $model;
	
	public function __construct(){
		parent::__construct();
		$this->common->check_user();
		$this->model = boa::model('news');
		$this->model->user_mode();
	}

	public function index(){
		$this->view->assign('title', '文章');
		$rs = $this->model->list($this->page);
		$page = $this->view->page($this->model->page, '?m=demo&c=user_news&page=#');
		$this->view->assign('list', $rs);
		$this->view->assign('page', $page);
		$this->view->html();
	}
	
	public function add(){
		$this->view->assign('title', '添加文章');
		$cat = boa::cache()->xget('demo.category'); // 调用缓存器
		$this->view->assign('cat', $cat);
		$this->view->html();
	}
	
	public function edit(){
		$this->view->assign('title', '修改文章');
		$rs = $this->model->get($this->id);
		$this->view->assign('v', $rs);
		$cat = boa::cache()->xget('demo.category'); // 调用缓存器
		$this->view->assign('cat', $cat);
		$this->view->html();
	}
	
	public function del(){
		$this->model->del($this->id);
		$this->view->jump('?m=demo&c=user_news', 3, '操作成功', false);
	}
	
	public function act(){
		$data = [
			'cid' => $this->cid,
			'title' => $this->title,
			'content' => $this->content
		];

		if($this->id > 0){ // 修改
			$data['status'] = 0;
			$this->model->act($data, $this->id);
		}else{ // 添加
			$data['user'] = $_SESSION['user']['user'];
			$data['addtime'] = time();
			$this->model->act($data);
		}

		$this->view->jump('?m=demo&c=user_news', 3, '操作成功', false);
	}
}
?>