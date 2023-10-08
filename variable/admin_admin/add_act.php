<?php
/* 验证：demo.admin_admin.add_act */
return [
	'user' => [
		'label' => '用户名',
		'check' => 'is_name'
	],
	'memo' => [
		'label' => '说明',
		'filter' => 'strip_tags'
	]
]
?>