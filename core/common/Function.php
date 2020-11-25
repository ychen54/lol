<?php 

function p($var){
    if(is_bool($var)){
        var_dump($var);
    }elseif(is_null($var)){
        var_dump(null);
    }else{
        echo "<pre style='position:relative;z-index:999;padding:10px;border-radius:5px;background:#ccc;border:1px solid #aaa;font-zize:14px;line-height:18px;opacity:0.9;'>".print_r($var,true)."</pre>";
    }    
}

/**
 * get post value from html
 * @AuthorHTL
 * @DateTime  2020-11-12T16:18:57+0800
 * @param     [type]                   $name    [name value]
 * @param     [type]                   $default [description]
 * @param     [type]                   $fitt    [description]
 * @return    [type]                            [description]
 */
function post($name, $default = false, $fitt = false){
	if(!isset($_POST) || !isset($_POST[$name])){
		return;
	}
	$v = $_POST[$name];
	if (isset($v)) {
		$v = trim($v);
    	$v = strip_tags($v);
    	$v = htmlentities($v,ENT_QUOTES,"UTF-8");
		if ($fitt) {
			switch ($fitt) {
				case 'int':
					if(is_numeric($v)){
						return $v;
					} else {
						return $default;
					}
					break;
				case 'string':
					if(is_string($v)){
						return $v;
					} else {
						return $default;
					}
					break;
				
				default:
					return $default;
					break;
			}
		}else{
			return $v;
		}
	} else {
		return $default;
	}
}


function get($name, $default = false, $fitt = false){
	if(!isset($_GET) || !isset($_GET[$name])){
		return;
	}
	$v = $_GET[$name];
	if (isset($v)) {
		$v = trim($v);
    	$v = strip_tags($v);
    	$v = htmlentities($v,ENT_QUOTES,"UTF-8");
		if ($fitt) {
			switch ($fitt) {
				case 'int':
					if(is_numeric($v)){
						return $v;
					} else {
						return $default;
					}
					break;
				case 'string':
					if(is_string($v)){
						return $v;
					} else {
						return $default;
					}
					break;
				
				default:
					return $default;
					break;
			}
		}else{
			return $v;
		}
	} else {
		return $default;
	}
}

function succ_jump($url, $str="Operation successfully"){
	echo "<pre style='position:relative;z-index:999;padding:10px;border-radius:5px;background:#43ad7f7f;border:1px solid #aaa;font-zize:14px;line-height:18px;opacity:0.9;'>".$str."</pre>";
	$u = "refresh:3;url=".$url;
	//p($u);
    header($u);
	//header("Location:".ROOT_PATH.'/'.$url);
	exit(); 
}

function fail_jump($url, $str="Operation Failed!"){
	echo "<pre style='position:relative;z-index:999;padding:10px;border-radius:5px;background:#ddad22;border:1px solid #aaa;font-zize:14px;line-height:18px;opacity:0.9;'>". $str."</pre>";
    header("refresh:3;url=".$url);
	//header("Location:".ROOT_PATH.'/'.$url);
	exit(); 
}

function checkEmail($email){
	// Create the syntactical validation regular expression
	$regex="/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
	return preg_match($regex,$email);
}




 ?>