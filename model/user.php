<?php
namespace mod\demo\model;

use boa\boa;

class user {
	private $db;
	public $page;

	public function __construct(){
		$this->db = boa::db();
	}
	
	public function list($page, $num = 10){
		if($page < 1) $page = 1;
		$offset = ($page - 1) * $num;
		$rs = $this->db->table('demo_user A')->join('demo_group B', 'A.gid = B.id')->field('A.*, B.name')->order('A.id DESC')->limit($offset, $num)->select();
		$this->page = $this->db->page();
		return $rs;
	}

	public function get($id){
		return $this->db->table('demo_user')->where('id = ?', $id)->find();
	}

	public function del($id){
		return $this->db->table('demo_user')->where('id = ?', $id)->delete();
	}

	public function act($data, $id = 0){
		if($id > 0){
			$this->db->table('demo_user')->where('id = ?', $id)->update($data);
		}else{
			$this->db->table('demo_user')->insert($data);
		}
	}
}
?>