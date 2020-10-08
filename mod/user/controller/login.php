<?php
namespace mod\user\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class login extends controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			boa::call('captcha.index.check'); //验证码校验

			$field = strpos($this->username, '@') ? 'email' : 'mobile';
			$rs = boa::db()->table('user')->where("$field = ?", $this->username)->find();
			if($rs){
				if($rs['password'] != md5($this->password)){
					msg::set('密码不正确');
				}else{
					boa::lib('tool')->do_login($rs);
					boa::session()->del('vcode');
					$this->view->json();
				}
			}else{
				msg::set('用户不存在');
			}
		}else{
			$goto = $this->goto ? $this->goto : $_SERVER['HTTP_REFERER'];
			if(!$goto){
				$goto = '/';
			}
			$this->view->assign('goto', $goto);
			$this->view->assign('title', '登录/Login');
			$this->view->html();
		}
	}

	public function register(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$db = boa::db();

			$rs = $db->table('user_code')->field('vcode')->where('mobile = ?', $this->mobile)->order('id DESC')->find();
			if(!$rs || $rs['vcode'] != $this->vcode){
				msg::set('验证码不正确！');
			}

			$rs = boa::db()->table('user')->field('id')->where('mobile = ?', $this->mobile)->find();
			if($rs){
				msg::set('用户已存在');
			}else{
				$nick = 'B'. mt_rand(100000, 999999);
				$data = [
					'mobile' => $this->mobile,
					'password' => md5($this->password),
					'nickname' => $nick,
					'regtime' => time(),
					'regip' => $_SERVER['REMOTE_ADDR']
				];
				$db->table('user')->insert($data);
				boa::security()->csrf()->delete();
				$this->view->json();
			}
		}else{
			$token = boa::security()->csrf()->create(); //csrf开启
			$this->view->assign('title', '注册/Register');
			$this->view->html();
		}
	}

	public function sendcode(){
		boa::security()->csrf()->validate(); //csrf校验
		$db = boa::db();

		$code = mt_rand(1000, 9999);
		//$res = boa::lib('alisms')->send($this->mobile, ['code' => $code]);

		$data = [
			'mobile' => $this->mobile,
			'vcode' => $code,
			'atime' => time()
		];
		$db->table('user_code')->insert($data);
		$this->view->json([], 0, '（demo）验证码为：'. $code);
	}

	public function forget(){
		if($this->act == 'send'){
			$db = boa::db();
			$rs = $db->table('user')->field('id, nickname')->where('email = ?', $this->email)->find();
			if($rs){
				$vcode = mt_rand(100000, 999999);
				$obj = boa::mail();				
				$obj->from = 'admin@boasoft.top BoaSoft';
				$res = $obj->send('BoaSoft密码重置验证码', '<h1>验证码：'. $vcode .'</h1><div>用于重置密码，24小时以内有效</div>', $this->email .' '. $rs['nickname']);
				if($res === 0){
					$data = [
						'email' => $this->email,
						'vcode' => $vcode,
						'atime' => time()
					];
					$db->table('user_reset')->insert($data);
					$this->view->json();
				}else{
					msg::set('boa.error.'. $res);
				}
			}else{
				msg::set('用户不存在或未设置邮箱');
			}
		}else if($this->act == 'reset'){
			boa::security()->csrf()->validate(); //csrf校验
			$db = boa::db();
			$rs = $db->table('user_reset')->where('email = ?', $this->email)->order('id DESC')->find();
			if($rs){
				if($rs['atime'] + 86400 < time()){
					msg::set('验证码已失效');
				}
				if($rs['vcode'] != $this->vcode){
					msg::set('验证码错误');
				}

				$data = [
					'password' => md5($this->password)
				];
				$db->table('user')->where('email = ?', $this->email)->update($data);
				$db->table('user_reset')->where('email = ?', $this->email)->delete();
				boa::security()->csrf()->delete();
				$this->view->json();
			}else{
				msg::set('验证码不存在');
			}
		}else{
			$token = boa::security()->csrf()->create();
			$this->view->assign('title', '忘记密码/Forget');
			$this->view->html();
		}
	}

	public function logout(){
		boa::session()->del('user');
		$this->view->jump('/');
	}
}
?>