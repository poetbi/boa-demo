<?php
/* 验证：demo.admin_cat.act */
return [
	'id' => [
		'label' => 'ID',
		'filter' => 'intval'
	],
	'title' => [
		'label' => '分类',
		'check' => 'required',
		'filter' => 'strip_tags'
	],
	'alias' => [
		'label' => '别名',
		'check' => 'is_name'
	],
	'sort' => [
		'label' => '排序',
		'filter' => 'intval'
	]
]
?>