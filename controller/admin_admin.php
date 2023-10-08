<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class admin_admin extends controller{
	private $model;

	public function __construct(){
		parent::__construct();
		$this->common->check_admin();
		$this->model = boa::model('admin');
	}
	
	public function index(){
		$this->view->assign('title', '管理员');
		$rs = $this->model->list($this->page);
		$page = $this->view->page($this->model->page, '?m=demo&c=admin_admin&page=#');
		$this->view->assign('list', $rs);
		$this->view->assign('page', $page);
		$this->view->html();
	}
	
	public function add(){
		$this->view->assign('title', '添加管理员');
		$this->view->html();
	}
	
	public function edit(){
		$this->view->assign('title', '修改管理员');
		$rs = $this->model->get($this->id);
		$this->view->assign('v', $rs);
		$this->view->html();
	}
	
	public function perm(){
		$this->view->assign('title', '配置权限');
		$file = BS_WWW .'cfg/perm-demo-'. $this->user .'.php';
		$str = file_get_contents($file);
		preg_match('/<\?php([\s\S]+?)\?>/', $str, $arr);
		$this->view->assign('v', $arr[1]);
		$this->view->html();
	}
	
	public function do_perm(){
		$file = BS_WWW .'cfg/perm-demo-'. $this->user .'.php';
		$str = '<?php '. $this->perm .' ?>';
		file_put_contents($file, $str);
		boa::cache()->clear();
		$this->view->jump('?m=demo&c=admin_admin', 3, '操作成功', false);
	}
	
	public function del(){
		$this->model->del($this->id);
		$this->view->jump('?m=demo&c=admin_admin', 3, '操作成功', false);
	}
	
	public function add_act(){
		$data = [
			'user' => $this->user,
			'memo' => $this->memo
		];
		if($this->pass){
			$data['pass'] = md5($this->pass . SALT);
		}
		$this->model->act($data);
		$this->view->jump('?m=demo&c=admin_admin', 3, '操作成功', false);
	}
	
	public function edit_act(){
		$data = [
			'memo' => $this->memo
		];
		if($this->pass){
			$data['pass'] = md5($this->pass . SALT);
		}
		$this->model->act($data, $this->id);
		$this->view->jump('?m=demo&c=admin_admin', 3, '操作成功', false);
	}
}
?>