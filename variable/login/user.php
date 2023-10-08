<?php
/* 验证：demo.login.user */
return [
	'user' => [
		'label' => '用户名',
		'check' => 'is_name',
		'chars' => '>=3 & <=15'
	],
	'pass' => [
		'label' => '密码',
		'chars' => '>=3'
	],
	'code' => [
		'label' => '验证码',
		'chars' => '=4'
	]
]
?>