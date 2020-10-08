<?php
return [
	'mobile' => [
		'label' => '手机',
		'check' => 'is_mobile_cn'
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