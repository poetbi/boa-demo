<?php
return [
	'email' => [
		'label' => '邮箱',
		'check' => 'is_email'
	],
	'password' => [
		'label' => '密码',
		'check' => 'required'
	],
	'vcode' => [
		'label' => '验证码',
		'check' => 'required',
		'chars' => '>=4'
	]
]
?>