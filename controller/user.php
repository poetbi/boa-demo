<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class user extends controller{
	public function __construct(){
		parent::__construct();
		$this->common->check_user();
	}

	public function index(){
		$this->view->assign('title', '用户后台');
		$this->view->html();
	}

	public function panel(){
		$this->view->html();
	}
}
?>