<?php
/* 验证：demo.admin_user.act */
return [
	'id' => [
		'label' => 'ID',
		'filter' => 'intval'
	],
	'gid' => [
		'label' => '组ID',
		'filter' => 'intval'
	],
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