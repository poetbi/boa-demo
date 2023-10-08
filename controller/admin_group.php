<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class admin_group extends controller{
	private $model;
	
	public function __construct(){
		parent::__construct();
		$this->common->check_admin();
		$this->model = boa::model('group');
	}

	public function index(){
		$this->view->assign('title', '用户组');
		$rs = $this->model->list($this->page);
		$page = $this->view->page($this->model->page, '?m=demo&c=admin_group&page=#');
		$this->view->assign('list', $rs);
		$this->view->assign('page', $page);
		$this->view->html();
	}
	
	public function add(){
		$this->view->assign('title', '新建用户组');
		$this->view->html();
	}
	
	public function edit(){
		$this->view->assign('title', '修改用户组');
		$rs = $this->model->get($this->id);
		$this->view->assign('v', $rs);
		$this->view->html();
	}

	public function perm(){
		$this->view->assign('title', '配置权限');
		$file = BS_WWW .'cfg/perm-demo-'. $this->id .'.php';
		$str = file_get_contents($file);
		preg_match('/<\?php([\s\S]+?)\?>/', $str, $arr);
		$this->view->assign('v', $arr[1]);
		$this->view->html();
	}
	
	public function do_perm(){
		$file = BS_WWW .'cfg/perm-demo-'. $this->id .'.php';
		$str = '<?php '. $this->perm .' ?>';
		file_put_contents($file, $str);
		boa::cache()->clear();
		$this->view->jump('?m=demo&c=admin_group', 3, '操作成功', false);
	}
	
	public function act(){
		$data = [
			'name' => $this->name,
			'memo' => $this->memo
		];

		if($this->id > 0){ // 修改
			$this->model->act($data, $this->id);
		}else{ // 添加
			$this->model->act($data);
		}

		$this->view->jump('?m=demo&c=admin_group', 3, '操作成功', false);
	}
}
?>