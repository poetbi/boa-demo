<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class admin_user extends controller{
	private $model;

	public function __construct(){
		parent::__construct();
		$this->common->check_admin();
		$this->model = boa::model('user');
	}
	
	public function index(){
		$this->view->assign('title', '用户');
		$rs = $this->model->list($this->page);
		$page = $this->view->page($this->model->page, '?m=demo&c=admin_user&page=#');
		$this->view->assign('list', $rs);
		$this->view->assign('page', $page);
		$this->view->html();
	}
	
	public function edit(){
		$this->view->assign('title', '修改用户');
		$rs = $this->model->get($this->id);
		$this->view->assign('v', $rs);
		$this->view->html();
	}
	
	public function del(){
		$this->model->del($this->id);
		$this->view->jump('?m=demo&c=admin_user', 3, '操作成功', false);
	}
	
	public function act(){
		$data = [
			'gid' => $this->gid,
			'sex' => $this->sex,
			'email' => $this->email
		];
		if($this->pass){
			$data['pass'] = md5($this->pass . SALT);
		}
		$this->model->act($data, $this->id);
		$this->view->jump('?m=demo&c=admin_user', 3, '操作成功', false);
	}
}
?>