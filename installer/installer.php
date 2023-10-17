<?php
namespace mod\demo\installer;

use boa\boa;
use boa\msg;

class installer{
	private $mod = 'demo';

	public function install(){
		$db = boa::db();
		$file = boa::file();
		
		echo "安装表\n";
		$str = $this->sql();
		$arr = preg_split('/[\r\n]+/', $str);
		foreach($arr as $v){
			if($v){
				$sql .= $v;
				if(preg_match('/;$/', $v)){
					$sql = str_replace('bs_demo_', $db->cfg['prefix'] .'demo_', $sql);
					$db->execute($sql);
					$sql = '';
				}
			}
		}
		
		echo "设置文件\n";
		$file->copy_dir(BS_MOD . $this->mod .'/view', BS_WWW .'tpl/'. $this->mod);
		$file->copy_dir(BS_MOD . $this->mod .'/public', BS_WWW .'res/'. $this->mod);
		$file->copy_dir(BS_MOD . $this->mod .'/installer/cfg', BS_WWW .'cfg');

		echo "安装完成\n";
	}

	public function uninstall(){
		$db = boa::db();
		$file = boa::file();

		echo "删除表\n";
		$str = $this->sql();
		preg_match_all('/CREATE\s+TABLE ([^\(]+)\s*\(/i', $str, $arr);
		foreach($arr[1] as $v){
			if($v){
				$v = str_replace('bs_demo_', $db->cfg['prefix'] .'demo_', trim($v));
				$db->execute("DROP TABLE $v");
			}
		}
		
		echo "移除文件\n";
		$file->clear_dir(BS_WWW .'tpl/'. $this->mod, true);
		$file->clear_dir(BS_WWW .'res/'. $this->mod, true);
		$arr = $file->read_dir(BS_MOD . $this->mod .'/installer/cfg', 2);
		foreach($arr as $v){
			unlink(BS_WWW ."cfg/$v");
		}

		echo "卸载完成\n";
	}
	
	private function sql(){
		$str = file_get_contents(BS_MOD . $this->mod .'/installer/demo.sql');
		$str = preg_replace('/\-\-(.*?)[\r\n]+/', '', $str);
		$str = preg_replace('/\/\*(.*?)\*\/[;]?/', '', $str);
		return $str;
	}
}
?>