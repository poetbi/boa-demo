<?php
/* 验证：demo.admin_news.act */
return [
	'status' => [
		'label' => '状态',
		'filter' => 'intval'
	],
	'cid' => [
		'label' => '分类ID',
		'filter' => 'intval'
	],
	'title' => [
		'label' => '标题',
		'check' => 'required',
		'filter' => 'strip_tags'
	],
	'content' => [
		'label' => '内容',
		'check' => 'required',
		'filter' => 'xss'
	]
]
?>