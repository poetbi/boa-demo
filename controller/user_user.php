<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class user_user extends controller{
	private $model;

	public function __construct(){
		parent::__construct();
		$this->common->check_user();
		$this->model = boa::model('user');
	}
	
	public function index(){
		$this->view->assign('title', '修改资料');
		$rs = $this->model->get($_SESSION['user']['id']);
		$this->view->assign('v', $rs);
		$this->view->html();
	}
	
	public function act(){
		$data = [
			'sex' => $this->sex,
			'email' => $this->email
		];
		if($this->pass){
			$data['pass'] = md5($this->pass . SALT);
		}
		$this->model->act($data, $_SESSION['user']['id']);
		$this->view->jump('?m=demo&c=user_user', 3, '操作成功', false);
	}
}
?>