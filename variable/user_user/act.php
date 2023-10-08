<?php
/* 验证：demo.user_user.act */
return [
	'sex' => [
		'label' => '性别',
		'filter' => 'intval'
	],
	'email' => [
		'label' => 'Email',
		'check' => 'is_email'
	]
]
?>