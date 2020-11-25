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
		$res = $this->get($this->table,'*',array('image_no'=>$id));
		return $res;
	}
	public function addOne($data){
		$res = $this->insert($this->table,$data);
		return $this->id();
	}

	public function setOne($id, $data){
		$re = $this->update($this->table,$data,array('image_no'=>$id));
		return $re->rowCount();
	}

	public function deleteOne($id){
		$re = $this->delete($this->table,array('image_no'=>$id));
		return $re->rowCount();
	}

	public function getVerifyArticle(){
		$res = $this->query("SELECT a.article_no,a.title, c.cate_name, a.click, a.last_update_time FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id WHERE verify = 1")->fetchAll();
		return $res;
	}

	public function getVerifyArticleById($id){
		$res = $this->query("SELECT u.nick_name,a.article_no,a.title, c.cate_name, a.content,a.click, a.last_update_time, i.image_path FROM articles a LEFT JOIN categories c ON a.cate_id = c.cate_id LEFT JOIN users u ON a.uid = u.uid  LEFT JOIN article_images i ON i.article_no = a.article_no WHERE verify = 1 AND a.article_no ='".$id."'")->fetchAll();
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

}



 ?>