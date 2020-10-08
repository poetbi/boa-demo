<?php
namespace mod\user\library;

use boa\boa;

class tool{
	public function check_user(){
		$user = boa::session()->get('user');
		if(!$user){
			boa::view()->jump('/index.php?m=user&c=login&goto='. urlencode($_SERVER['REQUEST_URI']));
		}
		return $user;
	}

	public function do_login($rs){
		$data = [
			'logtime' => time(),
			'logip' => $_SERVER['REMOTE_ADDR']
		];
		boa::db()->table('user')->where('id = ?', $rs['id'])->update($data);

		$arr = [
			'id' => $rs['id'],
			'mobile' => $rs['mobile'],
			'nickname' => $rs['nickname'],
			'avatar' => $rs['avatar']
		];
		boa::session()->set('user', $arr);
	}
}
?>