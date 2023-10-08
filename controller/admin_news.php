<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class admin_news extends controller{
	private $model;
	
	public function __construct(){
		parent::__construct();
		$this->common->check_admin();
		$this->model = boa::model('news');
	}

	public function index(){
		$this->view->assign('title', '文章');
		$rs = $this->model->list($this->page);
		$page = $this->view->page($this->model->page, '?m=demo&c=admin_news&page=#');
		$this->view->assign('list', $rs);
		$this->view->assign('page', $page);
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
		$this->view->jump('?m=demo&c=admin_news', 3, '操作成功', false);
	}
	
	public function act(){
		$data = [
			'status' => $this->status,
			'cid' => $this->cid,
			'title' => $this->title,
			'content' => $this->content
		];
		$this->model->act($data, $this->id);
		$this->view->jump('?m=demo&c=admin_news', 3, '操作成功', false);
	}
}
?>