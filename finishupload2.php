<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<title>
		完成 = Snakes =
	</title>
	<link rel="stylesheet" type="text/css" href="/style3.css">
	<script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
	<script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$']]}});</script>
	<?php
		include ("script3.php");
		checkadmin();
	?>
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
				上传成功
			</div>
			<div class="text">
				<?php
					echo "<p>文件名：　".$_GET['upload']."</p>";
					echo "<p>文件类型：".$_GET['type']."</p>";
					echo "<p>文件大小：".$_GET['size']."</p>";
					echo "<p>储存在 '/".$_GET['store']."'。 </p>";
				?>
			</div>
		</div>
		<?php
			include ("foot2.php");
		?>
	</div>
</body>
</html>
