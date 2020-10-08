<?php
namespace mod\user\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class index extends controller{
	public function __construct(){
		parent::__construct();
		$this->user = boa::lib('tool')->check_user();
	}

	public function index(){
		//$this->view->html();
	}

	public function profile(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$data = [
				'nickname' => $this->nickname,
				'email' => $this->email,
				'avatar' => $this->avatar
			];
			if($this->password){
				$data['password'] = md5($this->password);
			}

			boa::db()->table('user')->where('id = ?', $this->user['id'])->update($data);
			$session = boa::session();
			$session->set('user.nickname', $this->nickname);
			$session->set('user.avatar', $this->avatar);
			$this->view->json();
		}else{
			$rs = boa::db()->table('user')->where('id = ?', $this->user['id'])->find();
			$this->view->assign('v', $rs);
			$this->view->assign('title', '修改资料/Profile');
			$this->view->html();
		}
	}
}
?>