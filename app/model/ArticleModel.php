<?php 
namespace app\model;

use \core\lib\Model;

class ArticleModel extends Model{
	public $table = 'articles';
	public function lists(){
		$ret = $this->select($this->table, '*');
		return $ret;
	}

	public function getOne($id){
		$res = $this->get($this->table,'*',array('article_no'=>$id));
		return $res;
	}
	public function addOne($data){
		$res = $this->insert($this->table,$data);
		return $this->id();
	}

	public function setOne($id, $data){
		$re = $this->update($this->table,$data,array('article_no'=>$id));
		return $re->rowCount();
	}

	public function deleteOne($id){
		$re = $this->delete($this->table,array('article_no'=>$id));
		return $re->rowCount();
	}

	public function getVerifyArticle(){
		$res = $this->query("SELECT a.article_no,a.title, c.cate_name, a.click, a.last_update_time FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id WHERE verify = 1 ")->fetchAll();
		return $res;
	}

	public function getVerifyArticleByCate($cate_id){
		$res = $this->query("SELECT a.article_no,a.title, c.cate_name, a.click, a.last_update_time FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id WHERE c.cate_id='".$cate_id."' AND verify = 1 ")->fetchAll();
		return $res;
	}

	public function getVerifyArticleById($id){
		$res = $this->query("SELECT u.nick_name,a.article_no,a.title, c.cate_name, a.content,a.click, a.last_update_time, i.image_path, i.resize_path  FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id LEFT JOIN users u ON a.uid = u.uid  LEFT JOIN article_images i ON i.article_no = a.article_no WHERE verify = 1 AND a.article_no ='".$id."'")->fetchAll();
		return $res;
	}

	public function getAllArticle(){
		$res = $this->query("SELECT a.article_no, a.title, c.cate_name, a.click, a.verify,a.create_time FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id ")->fetchAll();
		return $res;
	}

	public function getAllArticleByUser($id){
		$res = $this->query("SELECT a.article_no,a.title, c.cate_name, a.click, a.verify,a.create_time FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id WHERE uid='".$id."'")->fetchAll();
		return $res;
	}

	public function addClick($id){
		$res = $this->query("UPDATE articles SET click=click+1 WHERE article_no='".$id."'");
	}

	public function queryOrder($order = "article_no", $sc = "asc"){
		$res = $this->query("SELECT a.article_no,a.title, c.cate_name, a.click, a.last_update_time FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id WHERE verify = 1 ORDER BY a.".$order." ".$sc)->fetchAll();
		return $res;
	}

	public function searchCount($cate_id, $keyword){
		$sql = "SELECT count(0) as con FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id WHERE verify = 1 ";
		if($cate_id != null && $cate_id != ""){
			$sql .= " AND a.cate_id = $cate_id ";
		}
		$sql .= " AND (a.title LiKE '%".$keyword."%'  OR a.content LIKE '%".$keyword."%')";
		$res = $this->query($sql)->fetchAll();
		return $res[0]['con'];
	}

	public function searchBy($cate_id, $keyword, $begin, $size){
		$sql = "SELECT a.article_no,a.title, c.cate_name, a.click, a.last_update_time  FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id WHERE verify = 1 ";
		if($cate_id != null && $cate_id != ""){
			$sql .= " AND a.cate_id = $cate_id ";
		}
		$sql .= " AND (a.title LiKE '%".$keyword."%'  OR a.content LIKE '%".$keyword."%') LIMIT $begin, $size ";
		$res = $this->query($sql)->fetchAll();
		return $res;
	}

}



 ?>