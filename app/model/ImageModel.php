<?php 
namespace app\model;

use \core\lib\Model;

class ImageModel extends Model{
	public $table = 'article_images';
	public function lists(){
		$ret = $this->select($this->table, '*');
		return $ret;
	}

	public function getOne($id){
		$res = $this->get($this->table,'*',array('article_no'=>$id));
		return $res;
	}

	public function setOne($id, $data){
		$re = $this->update($this->table,$data,array('image_no'=>$id));
		return $re->rowCount();
	}
	
	public function addOne($data){
		$res = $this->insert($this->table,$data);
		return $this->id();
	}

	public function deleteOne($id){
		$re = $this->delete($this->table,array('image_no'=>$id));
		return $re->rowCount();
	}

}



 ?>