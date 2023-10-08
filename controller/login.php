<?php
namespace mod\demo\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class login extends controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if($this->type == 1){ // URL中参数type=1时
			$title = '管理登录';
			$action = '?m=demo&c=login&a=admin';
			$goto = '?m=demo&c=admin';
			
			$rs = boa::db()->table('demo_admin')->field('user, pass')->where('id = 1')->find();
			if($rs && !$rs['pass']){
				$this->view->assign('user', $rs['user']);
				$this->view->assign('pass', '首次登录请在此设置密码');
			}
		}else{
			$title = '用户登录';
			$action = '?m=demo&c=login&a=user';
			$goto = '?m=demo&c=user';
		}
		$this->view->assign('title', $title);
		$this->view->assign('action', $action);
		$this->view->assign('goto', $goto);
		$this->view->html();
	}

	public function admin(){
		$pass = md5($this->pass . SALT);
		$goto = $this->goto ? $this->goto : '?m=demo';
		$this->vcode();

		$db = boa::db();
		$rs = $db->table('demo_admin')->field('id, user, pass')->where('user = ?', $this->user)->find();
		if(!$rs['pass'] || $rs['pass'] == $pass){ // 登录成功
			unset($rs['pass']);
			boa::session()->set('admin', $rs); // 设置session
			
			if(!$rs['pass']) $db->table('demo_admin')->where('id = ?', $rs['id'])->update(['pass' => $pass]); // 首次登录设置密码
			$this->view->jump($goto);
		}else{
			msg::set('用户名/密码错误');
		}
	}

	public function admin_logout(){
		boa::session()->del('admin');
		$this->view->jump('?m=demo');
	}

	public function user_logout(){
		boa::session()->del('user');
		$this->view->jump('?m=demo');
	}
	
	public function user(){
		$pass = md5($this->pass . SALT);
		$goto = $this->goto ? $this->goto : '?m=demo';
		$this->vcode();

		$db = boa::db();
		$rs = $db->table('demo_user')->field('id, gid, user, pass')->where('user = ?', $this->user)->find();
		if($rs['pass'] == $pass){ // 登录成功
			unset($rs['pass']);
			boa::session()->set('user', $rs); // 设置session
			$this->view->jump($goto);
		}else{
			msg::set('用户名/密码错误');
		}
	}

	/* 生成验证码图片 */
	public function code(){
		error_reporting(0);
		ob_clean();
		
		$vc = boa::lib('code');
		$vc->font(BS_WWW .'res/demo/elephant.ttf');
		$vc->doimg();

		boa::session()->set('code', $vc->getCode());
	}
	
	/* 校验验证码 */
	private function vcode(){
		$session = boa::session();
		$code = $session->get('code');

		if($code != $_POST['code']){
			msg::set('验证码错误');
		}
		$session->del('code');
	}
}
?>