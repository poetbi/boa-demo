<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class admin_cat extends controller{
	private $model;
	
	public function __construct(){
		parent::__construct();
		$this->common->check_admin();
		$this->model = boa::model('category');
	}

	public function index(){
		$this->view->assign('title', '分类');
		$rs = $this->model->list($this->page);
		$page = $this->view->page($this->model->page, '?m=demo&c=admin_cat&page=#');
		$this->view->assign('list', $rs);
		$this->view->assign('page', $page);
		$this->view->html();
	}
	
	public function add(){
		$this->view->assign('title', '新建分类');
		$this->view->html();
	}
	
	public function edit(){
		$this->view->assign('title', '修改分类');
		$rs = $this->model->get($this->id);
		$this->view->assign('v', $rs);
		$this->view->html();
	}
	
	public function del(){
		$this->model->del($this->id);
		boa::cache()->del('demo.category'); //重建缓存
		$this->view->jump('?m=demo&c=admin_cat', 3, '操作成功', false);
	}
	
	public function act(){
		$data = [
			'title' => $this->title,
			'alias' => $this->alias,
			'sort' => $this->sort
		];

		if($this->id > 0){ // 修改
			$this->model->act($data, $this->id);
		}else{ // 添加
			$this->model->act($data);
		}

		boa::cache()->del('demo.category'); //重建缓存
		$this->view->jump('?m=demo&c=admin_cat', 3, '操作成功', false);
	}
}
?>