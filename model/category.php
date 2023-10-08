<?php
namespace mod\demo\model;

use boa\boa;

class category {
	private $db;
	public $page;

	public function __construct(){
		$this->db = boa::db();
	}
	
	public function list($page, $num = 10){
		if($page < 1) $page = 1;
		$offset = ($page - 1) * $num;
		$rs = $this->db->table('demo_category')->order('sort ASC, id ASC')->limit($offset, $num)->select();
		$this->page = $this->db->page();
		return $rs;
	}

	public function get($id){
		return $this->db->table('demo_category')->where('id = ?', $id)->find();
	}

	public function del($id){
		return $this->db->table('demo_category')->where('id = ?', $id)->delete();
	}

	public function act($data, $id = 0){
		if($id > 0){
			$this->db->table('demo_category')->where('id = ?', $id)->update($data);
		}else{
			$this->db->table('demo_category')->insert($data);
		}
	}
}
?>