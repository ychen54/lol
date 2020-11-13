<?php 
namespace app\model;

use \core\lib\Model;



class UserModel extends Model{
	public $table = 'Users';
	public function lists(){
		$ret = $this->select($this->table, '*');
		return $ret;
	}

	public function getOne($id){
		$res = $this->get($this->table,'*',array('uid'=>$id));
		return $res;
	}

	public function setOne($id, $data){
		$re = $this->update($this->table,$data,array('uid'=>$id));
		return $re->rowCount();
	}

	public function deleteOne($id){
		$re = $this->delete($this->table,array('uid'=>$id));
		return $re->rowCount();
	}
}



 ?>