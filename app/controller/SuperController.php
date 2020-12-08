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

	public function deleteUser(){
		$no = post("id");
		$da = post("data", 1, 'int');
		$model = new UserModel();
		$data['disabled'] = $da;
		$row = $model->setOne($no,$data);
		if($row>0 && $da ==1){
			$arr['code'] = 1;
			$arr['msg'] = "Disable successfully";
			echo json_encode($arr);
		}else if($row>0 && $da ==0){
			$arr['code'] = 1;
			$arr['msg'] = "Enable successfully";
			echo json_encode($arr);
		}else{
			$arr['code'] = 0;
			$arr['msg'] = "Operation failed!";
			echo json_encode($arr);
		}
	}

	public function users(){
		$title = "Users";
		
		$model = new UserModel();
		$users = $model->lists();
		//var_dump($res)
		$this->assign('users', $users);
		$this->assign('title', $title);
		$this->display('users.php');
	}

	public function addUser(){
		$data['nick_name'] = post('nickname');
		$data['email'] = post('email');
		$data['password'] = post('password');
		$arr = array();
		$model = new UserModel();
		$res = $model->getOneByEmail($data['email']);
		if(!checkEmail($data['email']) || isset($res['uid'])){
			$arr['code'] = 0;
			$arr['msg'] = "invalid email or the email have been registered";
			echo json_encode($arr);
			return;
		}
		if($data['nick_name'] == ""){
			$arr['code'] = 0;
			$arr['msg'] = "nickname can't be empty!";
			echo json_encode($arr);
			return;
		}
		if($data['password'] == ""){
			$arr['code'] = 0;
			$arr['msg'] = "password can't be empty!";
			echo json_encode($arr);
			return;
		}
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		$data['type'] = 'login';
		$data['create_time'] = date("Y-m-d H:i:s", time());
		$data['last_update_time'] = date("Y-m-d H:i:s", time());
		$res1 = $model->addOne($data);
		if($res1 < 1){
			$arr['code'] = 0;
			$arr['msg'] = "add user failed!";
			echo json_encode($arr);
			return;
		}
		$arr['code'] = 1;
		$arr['msg'] = "add user success";
		echo json_encode($arr);
	}

	public function edit(){
		
	}




}



 ?>