<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class index extends controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->view->assign('title', '首页');
		
		$cat = boa::cache()->xget('demo.category'); // 调用缓存器
		$this->view->assign('cat', $cat);
		
		$this->view->html();
	}

	public function category(){
		$model = boa::model('news');
		$rs = $model->list_cat($this->page, $this->id);
		$page = $this->view->page($model->page, '?m=demo&c=index&a=category&id='. $this->id .'&page=#');
		$this->view->assign('list', $rs);
		$this->view->assign('page', $page);
		
		$cat = boa::cache()->xget('demo.category'); // 调用缓存器
		$this->view->assign('cat', $cat);
		$this->view->assign('title', $cat[$this->id]);
		
		$this->view->html();
	}

	public function content(){
		$model = boa::model('news');
		$rs = $model->get($this->id);
		$this->view->assign('rs', $rs);

		$this->view->assign('title', $rs['title']);
		
		$cat = boa::cache()->xget('demo.category'); // 调用缓存器
		$this->view->assign('cat', $cat);
		
		$this->view->html();
	}

	public function reg(){
		$this->view->assign('title', '用户注册');		
		$this->view->html();
	}

	public function reg_act(){
		$data = [
			'user' => $this->user,
			'pass' => md5($this->pass . SALT),
			'sex' => $this->sex,
			'email' => $this->email,
			'regtime' => time()
		];
		boa::model('demo.user')->act($data);
		$this->view->jump('?m=demo&c=login', 3, '操作成功', false);
	}
}
?>