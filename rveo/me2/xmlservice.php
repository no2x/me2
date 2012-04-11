<?php
/*
AJAX向服务器发送请求，服务器接收到请求后对数据进行处理，
最后内容拼成字符串或XML的形式输出返回，否则浏览器接收不到数据。。
*/
header("content-type: text/html;charset=utf-8");

if ( !empty( $_GET['fr'] ))
{
	$str = $_GET['fr'];
	$strtime = $_GET['MT'];
	if ( !empty( $_GET['isie'] ))
	{
		$str = iconv('gbk//IGNORE', 'utf-8//IGNORE', $str );
	} else {
		$str = iconv('utf-8//IGNORE', 'utf-8//IGNORE', $str );
	}
	echo ('传递参数 = '. $str );
	echo ('<br/>传递参数时间 = '. $strtime );
}
if ( !empty( $_POST['fr'] ))
{
	$str = $_POST['fr'];
	$strs = $_POST['frs'];
	$strtime = $_POST['MT'];
	if ( !empty( $_GET['isie'] ))
	{
		$str = iconv('utf-8//IGNORE', 'utf-8//IGNORE', $str );
		$strs = iconv('utf-8//IGNORE', 'utf-8//IGNORE', $strs );
	} else {
		$str = iconv('utf-8//IGNORE', 'utf-8//IGNORE', $str );
		$strs = iconv('utf-8//IGNORE', 'utf-8//IGNORE', $strs );
	}
	echo ('传递参数 = '. $str );
	echo ('<br/>传递参数 = '. $strs );
	echo ('<br/>传递参数时间 = '. $strtime );
}
?>