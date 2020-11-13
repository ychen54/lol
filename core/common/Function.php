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

function succ_jump($url){
	echo "<pre style='position:relative;z-index:999;padding:10px;border-radius:5px;background:#ccc;border:1px solid #aaa;font-zize:14px;line-height:18px;opacity:0.9;'>Operation successfully</pre>";
	$u = "refresh:3;url=".PROJECT.$url;
	//p($u);
    header($u);
	//header("Location:".ROOT_PATH.'/'.$url);
	exit(); 
}

function fail_jump($url){
	echo "<pre style='position:relative;z-index:999;padding:10px;border-radius:5px;background:#ccc;border:1px solid #aaa;font-zize:14px;line-height:18px;opacity:0.9;'>Operation Failed</pre>";
    header("refresh:3;url=".$url);
	//header("Location:".ROOT_PATH.'/'.$url);
	exit(); 
}




 ?>