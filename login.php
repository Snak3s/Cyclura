<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<title>
		登录 = Snakes =
	</title>
	<link rel="stylesheet" type="text/css" href="/style3.css">
	<script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
	<script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$']]}});</script>
	<?php
		include("script3.php");
	?>
	<script>
		function login()
		{
			document.getElementById("tip").innerText="正在登录，请稍后……";
			var xmlhttp;
			if (window.XMLHttpRequest)
				xmlhttp=new XMLHttpRequest();
			else
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4&&xmlhttp.status==200)
					if (xmlhttp.responseText)
						document.getElementById("tip").innerText=xmlhttp.responseText;
					else
						window.location.href="/";
			}
			xmlhttp.open("POST","trylogin.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("username="+encodeURIComponent(document.getElementById("username").value)+"&password="+encodeURIComponent(document.getElementById("password").value));
		}
		function keyDown(e)
		{
			var currKey=0,e=e||event;
			currKey=e.keyCode||e.which||e.charCode;
			if (currKey==13)
				login();
		}
		document.onkeydown = keyDown;
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
				登录
			</div>
			<div class="text">
				<table>
					<tr>
						<td>
							用户名
						</td>
						<td>
							<input class="input" type="text" id="username" value=""/>
						</td>
					</tr>
						<td>
							密码
						</td>
						<td>
							<input class="input" type="password" id="password" value=""/>
						</td>
					</tr>
				</table>
				<div class="button with-border" onclick="javascript:login();">登录</div>
				<div id="tip" class="button"></div>
			</div>
			<div class="clear"></div>
		</div>
		<?php
			include("foot2.php");
		?>
	</div>
</body>
</html>
