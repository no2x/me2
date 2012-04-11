<?php

define( 'rveoUri', $_SERVER["REQUEST_URI"] );

define( 'rveoUrs', $_SERVER['QUERY_STRING'] );

echo ('<html>');
echo ('<head>');
echo ('<title>fsodo</title>');
echo ('<meta http-equiv="content-type" content="text/html; charset=utf-8" />');
echo ('</head>');
echo ('<body>');

if ( defined('rveoUri') && defined('rveoUrs') && ( rveoUri == '/fsodo.xx2w' ))
{
	echo ('<br/>
		<br/>
			<div style="width:100%; text-align:center;">
				<a href="/fsodo.xx2w/fso/do?At=Location.html">/fsodo.xx2w/fso/do?At=Location.html</a>
			</div>
	<!-- End -->');
}
else
{

	$root = dirname(__FILE__).DIRECTORY_SEPARATOR;
	$path = $root.'/files/html/';
	for ( $i = 40; $i < 60; $i++ )
	{
		$file = $i .'.html';
		$url = 'http://book.qq.com/s/book/0/19/19150/'. $i .'.shtml';
		$contents = file_get_contents( $url );
		$contents = preg_replace( "/^([\s\S]*?)<div id=\"content\"([\s\S]*?)>([\s\S]*?)<\/div>([\s\S]*?)$/", "<div>\\3</div>", $contents );
		$HTML = $contents;
		$HTML = iconv('gbk//IGNORE', 'utf-8//IGNORE', $HTML );
		fso( $root, $path, $file, $HTML );
		echo ( $file .' '. date("Y-m-d H:i:s").' load done.<br/>');
	}
}
echo ('</body>');
echo ('</html>');

function fso( $root, $path, $file, $HTML )
{
	if ( !file_exists( $path ))
	{
		@mkdir( $path, '0666' );
		//echo ('建立目录 /files/html/ <br/>');
	}
	if ( is_dir( $path ) && is_writable( $path ))
	{
		$filepath = $path.$file;
		if ( !file_exists( $filepath ))
		{
			@file_put_contents( $filepath,'');
			//echo ('建立文件 /files/html/index.html<br/>');
		}
		$filectime = date("Y-m-d H:i:s", @filectime( $filepath ));
		$filemtime = date("Y-m-d H:i:s", @filemtime( $filepath ));
		//if ( strtotime( $filemtime ) < ( strtotime('now') - 15 ))
		//{
			$fsodo = @fopen( $filepath, 'w+');
			$HTML = '<html>
<head>
<title>'. $file .'</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="astro.js"></script>
</head>
<body>
<!-- 中文 -->
'. $HTML .'
<!-- 中文 -->
</body>
</html>';
			@fwrite( $fsodo, $HTML );
			@fclose( $fsodo );
		//}
		//echo ( $filectime .' created done.<br/>');
		//echo ( $filemtime .' writed done.<br/>');
		//echo ( date("Y-m-d H:i:s").' load done.<br/>');
	}
	else
	{
		//echo ('目录不存在或没有读写权限');
	}
}
?>