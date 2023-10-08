<?php
/* 验证：demo.admin_group.act */
return [
	'id' => [
		'label' => 'ID',
		'filter' => 'intval'
	],
	'name' => [
		'label' => '组名',
		'check' => 'required',
		'filter' => 'strip_tags'
	]
]
?>