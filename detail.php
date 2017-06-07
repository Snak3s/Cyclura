<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<?php
		include("script3.php");
	?>
	<title>
		<?php
			echo title($_GET["id"]);
		?>
		= Snakes =
	</title>
	<link rel="stylesheet" type="text/css" href="/style3.css">
	<script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
	<script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$']]}});</script>
	<script>
		function comment()
		{
			var xmlhttp;
			if (window.XMLHttpRequest)
				xmlhttp=new XMLHttpRequest();
			else
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4&&xmlhttp.status==200)
					if (xmlhttp.responseText)
						document.getElementById("tip").innerHTML=xmlhttp.responseText;
					else
						window.location.href="/detail/"+<?php echo $_GET["id"];?>;
			}
			xmlhttp.open("POST","/comment.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("user="+encodeURIComponent(document.getElementById("username").value)+"&text="+encodeURIComponent(document.getElementById("comment").innerText)+"&id="+<?php echo $_GET["id"];?>);
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
			<?php
				if (isadmin($_SESSION["account"]))
				{
					echo "<a href=\"/modify.php?id=".$_GET["id"]."\">\n<div class=\"button with-border\">\n修改\n</div>\n</a>";
					echo "<a href=\"/delete.php?id=".$_GET["id"]."\">\n<div class=\"button with-border\">\n删除\n</div>\n</a>";
				}
			?>
			<div class="article">
				<?php
					echo title($_GET["id"]);
				?>
			</div>
			<div class="time">
				<?php
					echo timepost($_GET["id"]);
				?>
			</div>
			<div class="text" id="maintext">
				<?php echo mdtext($_GET["id"]);?>
			</div>
		</div>
		<div class="content"> 
			<div class="article">
				评论区
			</div>
			<?php
				showcomment($_GET["id"]);
			?>
		</div>
		<div class="content"> 
			<div class="article">
				发表评论
			</div>
			<div class="text">
				<table>
					<tr>
						<td>
							昵称<span style="color: #DD0000;">*</span>
						</td>
						<td>
							<input class="input" type="text" id="username" value="<?php echo $_SESSION['account'];?>"/>
						</td>
					</tr>
				</table>
				<pre id="comment" class="input input-min" contenteditable="true"></pre>
				<div class="button with-border" onclick="javascript:comment();">评论</div>
				<div id="tip" class="button"></div>
				<div class="clear"></div>
			</div>
		</div>
		<?php
			include("foot2.php");
		?>
	</div>
</body>
</html>
