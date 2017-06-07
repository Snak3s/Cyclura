<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<title>
		修改 = Snakes =
	</title>
	<link rel="stylesheet" type="text/css" href="/style3.css">
	<script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
	<script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$']]}});</script>
	<?php
		include ("script3.php");
		checklogin();
		checkadmin();
	?>
	<script>
		function post()
		{
			var xmlhttp;
			if (window.XMLHttpRequest)
				xmlhttp=new XMLHttpRequest();
			else
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.open("POST","/trymodify.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("title="+encodeURIComponent(document.getElementById("title").value)+"&text="+encodeURIComponent(document.getElementById("editor").innerText)+"&id=<?php echo $_GET['id'];?>");
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4&&xmlhttp.status==200)
					if (xmlhttp.responseText)
						document.getElementById("tip").innerHTML=xmlhttp.responseText;
					else
						window.location.href="/";
			}
		}
		function preview()
		{
			var xmlhttp;
			if (window.XMLHttpRequest)
				xmlhttp=new XMLHttpRequest();
			else
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.open("POST","/preview.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("markdown="+encodeURIComponent(document.getElementById("editor").innerText));
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4&&xmlhttp.status==200)
					document.getElementById("preview").innerHTML=xmlhttp.responseText;
				MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
			}
		}
	</script>
</head>
<body style="margin: 0px;">
	<div class="page">
		<a href="/">
			<div class="title">
				Snakes
			</div>
		</a>
		<div class="content">
			<div class="article">
				修改
			</div>
			<div class="text">
				标题：<input class="input" type="input" id="title" value="<?php echo title($_GET["id"]);?>"/>
				<pre id="editor" class="input input-min" contenteditable="true"><?php echo mdcode($_GET["id"]);?></pre>
				<input class="button with-border" type="submit" onclick="preview();" value="预览"/>
				<input class="button with-border" type="submit" onclick="post();" value="发布"/>
				<div class="button" id="tip"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="content">
			<div class="article">
				预览区
			</div>
			<div id="preview" class="text">
			</div>
			<div class="clear"></div>
		</div>
		<?php
			include("foot2.php");
		?>
	</div>
</body>
</html>
