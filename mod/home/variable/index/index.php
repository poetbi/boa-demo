<?php
/*
; = and
| = or
label
chars  > < >= <= =
value  > < >= <= =
items  > < >= <= = != <>
equal  password
check  
filter htmlspecialchars;intval;''

按照定义顺序执行，filter在前就是先过滤再验证，在后则是先验证再过滤
'name' => [
	'label' => '用户名',
	'chars' => '>0',
	'value' => '>0; <10',
	'equal' => 'password',
	'check' => 'required&is_email&is_url;is_number;is_alnum...',
	'filter' => 'htmlspecialchars'
]

条件运算符  算术运算符  验证项  过滤器
*/
return [
	'name' => [
		'label' => '用户名',
		'filter' => ''
	],
]
?>