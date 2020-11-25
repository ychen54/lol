<?php 
namespace app\model;

use \core\lib\Model;

class CategoryModel extends Model{
	public $table = 'categories';
	public function lists(){
		$ret = $this->select($this->table, '*');
		return $ret;
	}

	public function getOne($id){
		$res = $this->get($this->table,'*',array('cate_id'=>$id));
		return $res;
	}

	public function setOne($id, $data){
		$re = $this->update($this->table,$data,array('cate_id'=>$id));
		return $re->rowCount();
	}

	public function deleteOne($id){
		$re = $this->delete($this->table,array('cate_id'=>$id));
		return $re->rowCount();
	}

	public function getParentCate(){
		$res = $this->query("SELECT * FROM categories WHERE parent_id IS NULL")->fetchAll();
		return $res;
	}

	public function listByParentId($id){
		$res = $this->select($this->table,'*',array('parent_id'=>$id));
		return $res;
	}
}



 ?>