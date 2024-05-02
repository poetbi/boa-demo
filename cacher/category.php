<?php
namespace mod\demo\cacher;

use boa\boa;
use boa\msg;
use boa\cache\cacher;

class category implements cacher{
	private $res;

	/*  缓存器演示：
	
		缓存所有文章分类，调用方法（无参数）：
		$arr = boa::cache()->xget('demo.category');
	*/
	public function __construct($args){
		
	}

	public function get(){
		$rs = boa::db()->table('demo_category')->field('id, title')->order('sort ASC, id ASC')->select();
		foreach($rs as $v){
			$arr[$v['id']] = $v['title'];
		}
		return $arr;
	}
}
?>