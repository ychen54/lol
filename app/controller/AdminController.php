<?php 

namespace app\controller;
use \app\model\UserModel;
use \app\model\CategoryModel;
use \app\model\ArticleModel;
use \app\model\ImageModel;
use \app\model\CommentModel;

class AdminController extends \core\Starter
{
	public function __construct(){
		if(session_status() == 1){
            session_start();    
        }
        if(!isset($_SESSION['uid']) || $_SESSION['uid']==''){
        	fail_jump("../index/index","You did not login!");
        }
        
	}

	public function index(){
		$title = "Admin";
		
		$model = new ArticleModel();
		$articles = [];
		if($_SESSION['type'] == 'admin'){
			$articles =  $model->getAllArticle();
		}else{
			$articles =  $model->getAllArticleByUser($_SESSION['uid']);
		}
		//var_dump($res)
		$this->assign('articles', $articles);
		$this->assign('title', $title);
		$this->display('admin.php');
	}

	public function add_article(){
		$title = "New Article";
		$catemodel = new CategoryModel();
		$parentCate = $catemodel->getParentCate();
		$childCate = $catemodel->listByParentId($parentCate[0]['cate_id']);
		$this->assign('title', $title);
		$this->assign('parentCate', $parentCate);
		$this->assign('childCate', $childCate);
		$this->display('article.php');
	}

	public function getCategoryByParentId(){
		$catemodel = new CategoryModel();
		$id = post('id',0,'int');
		$childCate = $catemodel->listByParentId($id);
		$arr['code'] = 1;
		$arr['data'] = $childCate;
		echo json_encode($arr);
	}

	public function addArticle(){
		$data['cate_id'] = post('cate');
		$data['title'] = post('title');
		$data['content'] = $_POST['content'];
		$data['prelink'] = post('prelink');
		if($data['cate_id'] == ''  ){
			fail_jump("/lol/admin/add_article","category can't be empty!");
			return;
		};
		if($data['title'] == ''  ){
			fail_jump("/lol/admin/add_article","title can't be empty!");
			return;
		};
		if($data['content'] == ''  ){
			fail_jump("/lol/admin/add_article","content can't be empty!");
			return;
		};
		if($data['prelink'] == ''  ){
			fail_jump("/lol/admin/add_article","prelink can't be empty!");
			return;
		};
		$data['uid'] = $_SESSION['uid'];
		$data['create_time'] = date("Y-m-d H:i:s", time());
		$data['last_update_time'] = date("Y-m-d H:i:s", time());

		$artmodel = new ArticleModel();
		if(isset($_FILES['img']) && isset($_FILES['img']['name']) && $_FILES['img']['name'] !=''){
			$img['image_name'] = $_FILES['img']['name'];
			$img['image_path'] = date("s", time()).$_FILES["img"]["name"];
			if( $_FILES["img"]["tmp_name"] == null || $_FILES["img"]["tmp_name"] =="" ||
				!file_is_an_image($_FILES["img"]["tmp_name"], $img['image_path']) ){
				fail_jump("/lol/admin/add_article","only upload image!");
				return;
			}
		}

		$art_no = $artmodel->addOne($data);
		if($art_no<1){
			fail_jump("/lol/admin/add_article","create article failed!");
			return;
		}
		if(isset($_FILES['img']) && isset($_FILES['img']['name']) && $_FILES['img']['name'] !=''){
			$img['image_name'] = $_FILES['img']['name'];
			$img['image_path'] = date("s", time()).$_FILES["img"]["name"];
			if( $_FILES["img"]["tmp_name"] == null || $_FILES["img"]["tmp_name"] =="" ||
				!file_is_an_image($_FILES["img"]["tmp_name"], $img['image_path']) ){
				fail_jump("/lol/admin/add_article","only upload image!");
				return;
			}
			move_uploaded_file($_FILES["img"]["tmp_name"],UPLOAD.$img['image_path']);
			// get extension of image
			$ext = explode(".", $img['image_name']);
    		$ext = $ext[count($ext)-1];
    		$img['resize_path'] = time().'.'.$ext;
    		// resize image size
			resize_image($img['image_path'],$img['resize_path']);
			$imgmodel = new ImageModel();
			$img['article_no'] = $art_no;
			$imgmodel->addOne($img);
		}
		succ_jump("/lol/admin/index","create article successfully!");
	}

	public function editArticle(){
		$id = get('id');
		$model = new ArticleModel();
		$res = [];
        if($_SESSION['type'] != 'admin'){
			$res =  $model->getAllArticleByUser($_SESSION['uid']);
			$flag = false;
			foreach ($res as $key => $value) {
				if($value['article_no'] == $id){
					$flag = true;
					break;
				}
			}
			if(!$flag){
				// the article didn't create by user
				fail_jump("/lol/admin/index","you can edit your article");
			}
		}
		$data = $model->getOne($id);
		$this->assign('data', $data);

		$title = "Edit Article";
		$catemodel = new CategoryModel();
		$parentCate = $catemodel->getParentCate();
		$childCate = $catemodel->listByParentId($parentCate[0]['cate_id']);
		$this->assign('title', $title);
		$this->assign('parentCate', $parentCate);
		$this->assign('childCate', $childCate);
		$this->display('article.php');
	}

	public function editAricleSubmit(){
		$data['article_no'] = post('article_no');
		$artmodel = new ArticleModel();
		$res = [];
        if($_SESSION['type'] != 'admin'){
			$res =  $artmodel->getAllArticleByUser($_SESSION['uid']);
			$flag = false;
			foreach ($res as $key => $value) {
				if($value['article_no'] == $data['article_no']){
					$flag = true;
					break;
				}
			}
			if(!$flag){
				// the article didn't create by user
				fail_jump("/lol/admin/index","you can edit your article");
				exit();
			}
		}

		$data['cate_id'] = post('cate');
		$data['title'] = post('title');
		$data['content'] = $_POST['content'];
		$data['prelink'] = post('prelink');
		
		if($data['cate_id'] == ''  ){
			fail_jump("/lol/admin/add_article","category can't be empty!");
			return;
		};
		if($data['title'] == ''  ){
			fail_jump("/lol/admin/add_article","title can't be empty!");
			return;
		};
		if($data['content'] == ''  ){
			fail_jump("/lol/admin/add_article","content can't be empty!");
			return;
		};
		if($data['prelink'] == ''  ){
			fail_jump("/lol/admin/add_article","prelink can't be empty!");
			return;
		};
		$data['uid'] = $_SESSION['uid'];
		$data['last_update_time'] = date("Y-m-d H:i:s", time());
		$artmodel->setOne($data['article_no'], $data);

		if(isset($_FILES['img']) && isset($_FILES['img']['name']) && $_FILES['img']['name'] !=''){
			if( !stristr($_FILES['img']['type'], 'image/') ){
				fail_jump("/lol/admin/add_article","only upload image!");
				return;
			}
			$imgmodel = new ImageModel();
			$oldimg = $imgmodel->getOne($data['article_no']);
			if($oldimg){
				// delete old image
				if(isset($oldimg['image_path']) && $oldimg['image_path'] != null){
					if(file_exists(UPLOAD.$oldimg['image_path'])){
						unlink(UPLOAD.$oldimg['image_path']);
					}
					
				}
				if(isset($oldimg['resize_path']) && $oldimg['resize_path'] != null){
					if(file_exists(UPLOAD.$oldimg['resize_path'])){
						unlink(UPLOAD.$oldimg['resize_path']);
					}
				}
			}

			$oldimg['article_no'] = $data['article_no'];
			$oldimg['image_name'] = $_FILES['img']['name'];
			$oldimg['image_path'] = date("s", time()).$_FILES["img"]["name"];
			move_uploaded_file($_FILES["img"]["tmp_name"],UPLOAD.$oldimg['image_path']);
			// get extension of image
			$ext = explode(".", $oldimg['image_name']);
    		$ext = $ext[count($ext)-1];
    		$oldimg['resize_path'] = time().'.'.$ext;
    		// resize image size
			resize_image($oldimg['image_path'],$oldimg['resize_path']);
			if(isset($oldimg['image_no'])){
				$imgmodel->setOne($oldimg['image_no'],$oldimg);
			}else{
				$imgmodel->addOne($oldimg);
			}
			
		}
		succ_jump("/lol/admin/index","edit article successfully!");
	}

	public function deleteArticle(){
		$id = get('id');
		$model = new ArticleModel();
		$res = [];
        if($_SESSION['type'] != 'admin'){
			$res =  $model->getAllArticleByUser($_SESSION['uid']);
			$flag = false;
			foreach ($res as $key => $value) {
				if($value['article_no'] == $id){
					$flag = true;
					break;
				}
			}
			if(!$flag){
				// the article didn't create by user
				fail_jump("/lol/admin/index","you can delete your article");
			}
		}
		$imgmodel = new ImageModel();
		$img = $imgmodel->getOne($id);
		if($img){
			if(isset($img['image_path']) && $img['image_path'] != null){
				if(file_exists(UPLOAD.$img['image_path'])){
						unlink(UPLOAD.$img['image_path']);
					}
			}
			if(isset($img['resize_path']) && $img['resize_path'] != null){
				if(file_exists(UPLOAD.$img['resize_path'])){
						unlink(UPLOAD.$img['resize_path']);
				}
			}
			$imgmodel->deleteOne($img['image_no']);
		}
		$model->deleteOne($id);
		succ_jump("/lol/admin/index","delete successfully!");

	}

	public function comments(){
		$title = "Comments";
		
		$model = new CommentModel();
		$articles = [];
		if($_SESSION['type'] == 'admin'){
			$comments =  $model->getAllComment();
		}else{
			$comments =  $model->getAllCommentByUser($_SESSION['uid']);
		}
		//var_dump($res)
		$this->assign('comments', $comments);
		$this->assign('title', $title);
		$this->display('comments.php');
	}

	public function confirmComment(){
		$no = post("id");
		$model = new CommentModel();
		$data['verify'] = 1;
		$row = $model->setOne($no,$data);
		if($row>0){
			$arr['code'] = 1;
			$arr['msg'] = "Confirm successfully";
			echo json_encode($arr);
		}else{
			$arr['code'] = 0;
			$arr['msg'] = "Confirm failed!";
			echo json_encode($arr);
		}
	}

	public function deleteComment(){
		$id = get('id');
		$model = new CommentModel();
		$res = [];
        if($_SESSION['type'] != 'admin'){
			$res =  $model->getAllCommentByUser($_SESSION['uid']);
			$flag = false;
			foreach ($res as $key => $value) {
				if($value['comment_no'] == $id){
					$flag = true;
					break;
				}
			}
			if(!$flag){
				// the article didn't create by user
				fail_jump("/lol/admin/comments","you can delete comments which belong to your article");
			}
		}
		$model->deleteOne($id);
		succ_jump("/lol/admin/comments","delete successfully!");
	}

}


 ?>