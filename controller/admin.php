<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class admin extends controller{
	public function __construct(){
		parent::__construct();
		$this->common->check_admin();
	}

	public function index(){
		$this->view->assign('title', '管理后台');
		$this->view->html();
	}

	public function panel(){
		$this->view->html();
	}
}
?>