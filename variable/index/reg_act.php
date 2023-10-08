<?php
/* 验证：demo.index.reg_act */
return [
	'user' => [
		'label' => '用户名',
		'chars' => '>=3 & <=15',
		'check' => 'is_name'
	],
	'pass' => [
		'label' => '密码',
		'chars' => '>=3',
		'equal' => 'pass2'
	],
	'sex' => [
		'label' => '性别',
		'check' => 'required'
	],
	'email' => [
		'label' => 'Email',
		'check' => 'is_email'
	]
]
?>