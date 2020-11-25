<?php 
namespace app\controller;

class AuthController extends \core\Starter {
	public function __construct(){
		if(session_status() == 1){
            session_start();    
        }
        if(!isset($_SESSION['uid']) || $_SESSION['uid']==''){
        	fail_jump("index/index","You did not login!");
        }
	}
}



 ?>