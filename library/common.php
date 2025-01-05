<?php
namespace mod\demo\library;

use boa\boa;

class common{
	public function __construct(){
		if(PHP_SAPI != 'cli'){
			$env = boa::env();
			$path = "mod/{$env['mod']}/controller/{$env['con']}.php ：{$env['act']}()";
			echo '<p style="position:fixed;bottom:0;right:0;color:red;">当前页面位于：'. $path .'</p>';
		}		
	}
	
	/* 检测管理员登录、权限 */
	public function check_admin(){
		$admin = boa::session()->get('admin');
		if(!$admin['id']){
			boa::view()->jump('?m=demo&c=login&type=1', 0, '请登录');
		}

		$user = $admin['user'];
		boa::permission()->validate("demo-$user", 'da'); // 验证管理权限
	}
	
	/* 检测用户登录、权限 */
	public function check_user(){
		$user = boa::session()->get('user');
		if(!$user['id']){
			boa::view()->jump('?m=demo&c=login', 0, '请登录');
		}

		$gid = $user['gid'];
		boa::permission()->validate("demo-$gid", 'a'); // 验证用户权限
	}
}
?>
