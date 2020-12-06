<?php 
namespace app\controller;
use \app\model\ArticleModel;
use \app\model\CommentModel;
use \app\model\UserModel;

class SuperController extends \core\Starter {
	public function __construct(){
		if(session_status() == 1){
            session_start();    
        }
        if(!isset($_SESSION['uid']) || $_SESSION['uid']==''){
        	fail_jump("index/index","You did not login!");
        }

        if(!isset($_SESSION['type']) || $_SESSION['type']!='admin'){
        	fail_jump("index/index","You did not have permission!");
        }
	}

	public function confirm(){
		$no = post("id");
		$model = new ArticleModel();
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

	public function users(){
		$title = "Users";
		
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
		$this->display('users.php');
	}


}



 ?>