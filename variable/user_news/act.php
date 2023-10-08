<?php
/* 验证：demo.user_news.act */
return [
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