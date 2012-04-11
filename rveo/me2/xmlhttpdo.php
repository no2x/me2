<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>XMLhttp Ajax for HTML</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" charset="utf-8">
function $(id){return document.getElementById(id);}
</script>
<script type="text/javascript" charset="utf-8" src="/files/script/xmlhttp.js"></script>
<script type="text/javascript">
function xx2wXMLhttpGet()
{
	var x = new XMLHTTP('HTML');
	x.get('/xmlservice.xx2w?fr=中文1中文&MT='+ Math.random(), function(s){
		var ot = $('loading');
                	ot.style.display = '';
		ot.innerHTML = s;
		});
}
function xx2wXMLhttpPost()
{
	var x = new XMLHTTP('HTML');
	x.post('/xmlservice.xx2w','fr=中文2中文&frs=66love孭&MT='+ Math.random(), function(s){
		var ot = $('loading2');
                	ot.style.display = '';
		ot.innerHTML = s;
		});
}
</script>
</head>
<body>
<div id="loading" onclick="xx2wXMLhttpGet();">Loading...</div>
<div id="loading2" onclick="xx2wXMLhttpPost();">Loading2...</div>
</body>
</html>