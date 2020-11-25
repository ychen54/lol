<?php 

namespace app\controller;
use \app\model\UserModel;
use \app\model\CategoryModel;
use \app\model\ArticleModel;
use \app\model\ImageModel;

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
		$data = "Admin page";
		
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
		$this->assign('data', $data);
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
			fail_jump("../admin/add_article","category can't be empty!");
			return;
		};
		if($data['title'] == ''  ){
			fail_jump("../admin/add_article","title can't be empty!");
			return;
		};
		if($data['content'] == ''  ){
			fail_jump("../admin/add_article","content can't be empty!");
			return;
		};
		if($data['prelink'] == ''  ){
			fail_jump("../admin/add_article","prelink can't be empty!");
			return;
		};
		$data['uid'] = $_SESSION['uid'];
		$data['create_time'] = date("Y-m-d H:i:s", time());
		$data['last_update_time'] = date("Y-m-d H:i:s", time());

		$artmodel = new ArticleModel();
		$art_no = $artmodel->addOne($data);
		if($art_no<1){
			fail_jump("../admin/add_article","create article failed!");
			return;
		}
		if(isset($_FILES['img']) && isset($_FILES['img']['name']) && $_FILES['img']['name'] !=''){
			if( !stristr($_FILES['img']['type'], 'image/') ){
				fail_jump("../admin/add_article","only upload image!");
				return;
			}
			$img['image_name'] = $_FILES['img']['name'];
			$img['image_path'] = date("s", time()).$_FILES["img"]["name"];
			move_uploaded_file($_FILES["img"]["tmp_name"],UPLOAD.$img['image_path']);
			$imgmodel = new ImageModel();
			$img['article_no'] = $art_no;
			$imgmodel->addOne($img);
		}
		succ_jump("../admin/index","create article successfully!");
	}

}


 ?>