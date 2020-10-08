<?php
namespace mod\captcha\controller;

use boa\boa;
use boa\msg;
use boa\controller;

class index extends controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		error_reporting(0);
		ob_clean();
		
		$vc = boa::lib('validate');
		$vc->doimg();

		boa::session()->set('vcode', $vc->getCode());
	}

	public function check(){
		$session = boa::session();
		$vcode = $session->get('vcode');

		if($vcode != $_POST['vcode']){
			msg::set('验证码错误！');
		}
		$session->del('vcode');
	}
}
?>