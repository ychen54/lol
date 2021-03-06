<?php 
namespace app\controller;
use \app\model\UserModel;
use \app\model\ArticleModel;
use \app\model\CommentModel;

class IndexController extends \core\Starter
{
	public function __construct(){
		if(session_status() == 1){
            session_start();    
        }
	}

	public function index()
	{
		$title = "Index";
		$articleModel = new ArticleModel();
		$order = get('order');
		$sc = get('sc');
		$articles = [];
		if($order != null && $sc != null){
			$articles = $articleModel->queryOrder($order, $sc);
			$this->assign('order', $order);
			$this->assign('sc', $sc);
		}else{
			$articles = $articleModel->getVerifyArticle();
		}
		$this->assign('articles', $articles);
		$this->assign('title', $title);
		$this->display('index.php');
	}

	public function category(){
		$id=get('id');
		$title = "Category";
		$articleModel = new ArticleModel();
		$articles = $articleModel->getVerifyArticleByCate($id);
		$this->assign('articles', $articles);
		$this->assign('title', $title);
		$this->assign('cate_id', 'category');
		$this->display('index.php');
	}

	public function detail(){
		$id = get('id');
		$articleModel = new ArticleModel();
		$article = $articleModel->getVerifyArticleById($id);
		if($article){
			$articleModel->addClick($id);
		}
		$commentModel = new CommentModel();
		$comments = $commentModel->getCommentByArticle($id);
		$this->assign('article', $article);
		$this->assign('comments', $comments);
		$this->display('detail.php');
	}

	public function login()
	{
		$title = "Login";
		$this->assign('title', $title);
		$this->display('login.php');
	}

	public function register()
	{
		$title = "Register";
		$this->assign('title', $title);
		$this->display('register.php');
	}

	public function logout()
	{
		unset($_SESSION['uid']);
		unset($_SESSION['nickname']);
		unset($_SESSION['type']);
		succ_jump("index/index", "Logout Successfully!");
	}

	public function add(){
		$data['nick_name'] = post('nickname');
		$data['email'] = post('email');
		$data['password'] = post('password');
		$data['captcha'] = post('captcha');
		$captcha = $_SESSION['captcha'];
		$arr = array();
		if(strtolower($data['captcha']) === $captcha){
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
			unset($data['captcha']);
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$data['type'] = 'login';
			$data['create_time'] = date("Y-m-d H:i:s", time());
			$data['last_update_time'] = date("Y-m-d H:i:s", time());
			$res1 = $model->addOne($data);
			if($res1 < 1){
				$arr['code'] = 0;
				$arr['msg'] = "register error!";
				echo json_encode($arr);
				return;
			}
			$arr['code'] = 1;
			$arr['msg'] = "register success";
		}else{
			$arr['code'] = 0;
			$arr['msg'] = "captcha error";
		}
		echo json_encode($arr);
	}

	public function captcha(){
		//Output image header information to browser
		header('Content-type:image/jpeg');
		$width=100;
		$height=30;
		$string='';//Define variable to save font
		$img=imagecreatetruecolor($width, $height);
		$arr=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4','5','6','7','8','9');
		//Generate colored pixels  
		$colorBg=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));
		//Fill color
		imagefill($img, 0, 0, $colorBg);
		//The loop, loop draw background interference points
		for($m=0;$m<=100;$m++){
		    $pointcolor=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		    imagesetpixel($img,rand(0,$width-1),rand(0,$height-1),$pointcolor);
		}
		//Draw interference lines in a loop
		/*for ($i=0;$i<=4;$i++){
		    $linecolor=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		    imageline($img,rand(0,$width),rand(0,$height),rand(0,$width),rand(0,$height),$linecolor);
		}*/
		for($i=0;$i<4;$i++){
			$string.=$arr[rand(0,count($arr)-1)];
		}
		$_SESSION['captcha'] = $string;
		$colorString=imagecolorallocate($img,rand(10,100),rand(10,100),rand(10,100));
		imagestring($img,5,rand(0,$width-36),rand(0,$height-15),$string,$colorString);
		//Output picture to browser
		imagejpeg($img);
		//Destroy, release resources
		imagedestroy($img);
	}

	public function search(){
		$cate_id = post("cate_id");
		$keyword = post("keyword");
		$pageSize = 5;
		$pageNum = post("pageNum",1, 'int');
		
		$articleModel = new ArticleModel();
		$count = $articleModel->searchCount($cate_id, $keyword);
		$total = ceil($count/$pageSize);

		$pageNum = $pageNum <1?1:$pageNum;
		$pageNum = $pageNum >$total?$total:$pageNum;

		$begin = ($pageNum-1)*$pageSize;

		$articles = $articleModel->searchBy($cate_id, $keyword, $begin, $pageSize);
		

		$this->assign('articles', $articles);
		$this->assign('total', $total);
		$this->assign('pageNum', $pageNum);
		$this->assign('title', "Search");
		$this->assign('search_cate', $cate_id);
		$this->assign('keyword', $keyword);
		$this->display('search.php');
	}

	public function verify(){
		$data['email'] = post('email');
		$data['password'] = post('password');
		$data['captcha'] = post('captcha');
		$captcha = $_SESSION['captcha'];
		if(strtolower($data['captcha']) === $captcha){
			if($data['email'] == '' || !checkEmail($data['email'])){
				$arr['code'] = 0;
				$arr['msg'] = "invalid email";
				echo json_encode($arr);
				return;
			}
			$model = new UserModel();
			$res = $model->getOneByEmail($data['email']);
			if($res && password_verify($data['password'],$res['password']) && $res['disabled'] == 0){
				$_SESSION['uid'] = $res['uid'];
				$_SESSION['nickname'] = $res['nick_name'];
				$_SESSION['type'] = $res['type'];

				$arr['code'] = 1;
				$arr['msg'] = "Login Successfully!";
				echo json_encode($arr);
				return;
			}else{
				$arr['code'] = 0;
				$arr['msg'] = "password error, or the account is disabled now";
				echo json_encode($arr);
				return;	
			}
		}else{
			$arr['code'] = 0;
			$arr['msg'] = "captcha error";
			echo json_encode($arr);
			return;
		}
		//var_dump($data);
		//var_dump($captcha);
	}

	public function addComment(){
		$article_no = post("article_no");
		$comment = post("comment");
		$captcha = post("captcha");
		if($comment == null || $comment == "" || strlen(trim($comment)) == 0){
			$arr['code'] = 0;
			$arr['msg'] = "comment can't be empty!";
			echo json_encode($arr);
			return;
		}
		if(strtolower($captcha) != $_SESSION['captcha']){
			$arr['code'] = 0;
			$arr['msg'] = "captcha error!";
			echo json_encode($arr);
			return;
		}
		$model = new CommentModel();
		$data['content'] = $comment;
		$data['article_no'] = $article_no;
		$data['verify'] = 0;
		$data['create_time'] = date("Y-m-d H:i:s", time());
		$count = $model->addOne($data);
		$arr['count'] = $count;
		if($count >0){
			$arr['code'] = 1;
			$arr['msg'] = "comment Successfully";
			echo json_encode($arr);
			return;
		}else{
			$arr['code'] = 0;
			$arr['msg'] = "comment failed!";
			echo json_encode($arr);
			return;
		}

	}

	
}




 ?>