<?php
namespace mod\demo\model;

use boa\boa;

class group {
	private $db;
	public $page;

	public function __construct(){
		$this->db = boa::db();
	}
	
	public function all(){
		return $this->db->table('demo_group')->field('id, name')->order('id ASC')->select();
	}
	
	public function list($page, $num = 10){
		if($page < 1) $page = 1;
		$offset = ($page - 1) * $num;
		$rs = $this->db->table('demo_group')->order('id ASC')->limit($offset, $num)->select();
		$this->page = $this->db->page();
		return $rs;
	}

	public function get($id){
		return $this->db->table('demo_group')->where('id = ?', $id)->find();
	}

	public function act($data, $id = 0){
		if($id > 0){
			$this->db->table('demo_group')->where('id = ?', $id)->update($data);
		}else{
			$this->db->table('demo_group')->insert($data);
		}
	}
}
?>