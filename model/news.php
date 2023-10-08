<?php
namespace mod\demo\model;

use boa\boa;

class news {
	private $db;
	public $page;
	private $user = null;

	public function __construct(){
		$this->db = boa::db();
	}

	public function user_mode(){
		$this->user = $_SESSION['user']['user'];
	}
	
	public function list($page, $num = 10){
		if($page < 1) $page = 1;
		$offset = ($page - 1) * $num;
		if($this->user) $where = "A.user = '{$this->user}'";
		$rs = $this->db->table('demo_news A')->join('demo_category B', 'A.cid = B.id')->field('A.id, A.cid, A.status, A.user, A.title, A.addtime, B.title AS category')->where($where)->order('A.id DESC')->limit($offset, $num)->select();
		$this->page = $this->db->page();
		return $rs;
	}
	
	public function list_cat($page, $cid, $num = 10){
		if($page < 1) $page = 1;
		$offset = ($page - 1) * $num;
		$rs = $this->db->table('demo_news')->field('id, title, addtime')->where('status = 1 AND cid = ?', $cid)->order('id DESC')->limit($offset, $num)->select();
		$this->page = $this->db->page();
		return $rs;
	}

	public function get($id){
		return $this->db->table('demo_news')->where('id = ?', $id)->find();
	}

	public function del($id){
		if($this->user){
			return $this->db->table('demo_news')->where('id = ? AND user = ?', $id, $this->user)->delete();
		}else{
			return $this->db->table('demo_news')->where('id = ?', $id)->delete();
		}
	}

	public function act($data, $id = 0){
		if($id > 0){
			if($this->user){
				$this->db->table('demo_news')->where('id = ? AND user = ?', $id, $this->user)->update($data);
			}else{
				$this->db->table('demo_news')->where('id = ?', $id)->update($data);
			}
		}else{
			$this->db->table('demo_news')->insert($data);
		}
	}
}
?>