<?php 
namespace app\controller;
use \app\model\UserModel;

class IndexController extends \core\Starter
{
	public function index()
	{
		//p('IndexController index');
		/*$insertdata = array(
			'age'=>12,
			'cup_size'=>'B',
			'sal'=>213
		);*/
		//$ret = $m->insert('girl', $insertdata);
		//var_dump($ret);
		//
		$model = new UserModel();
		$re = $model->lists();
		var_dump($re);

		//exit();
		//$sql = "SELECT * FROM girl";
		//$ret = $m->query($sql);
		//p($ret->fetchAll());
		$title = "View Page";
		$data = password_hash("admin@lol.com", PASSWORD_DEFAULT);
		$this->assign('title', $title);
		$this->assign('data', $data);
		$this->display('index.html');

	}

	public function hi()
	{
		$data = "Test World1223";
		$this->assign('data', $data);
		$this->display('hello.html');
	}

	public function add(){

		var_dump($_POST);
		$data['username'] = post('username','0','int');
		$data['password'] = post('password');

		var_dump($data);

		succ_jump("index/index");
	}
}




 ?>