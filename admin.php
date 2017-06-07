<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<?php
		include ("script3.php");
		checkadmin();
	?>
	<link rel="stylesheet" type="text/css" href="/style3.css">
	<script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
	<script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$']]}});</script>
	<title>
		管理 = Snakes =
	</title>
</head>
<body style="margin: 0px;">
	<div class="page">
		<a href="/">
			<div class="title">
				Snakes
			</div>
		</a>
		<div class="content">
			<div class="article">管理员</div>
			<?php
				showadmin();
			?>
			<div style="clear:both"></div> 
		</div>
		<div class="content">
			<div class="article">用户</div>
			<?php
				showuser();
			?>
			<div style="clear:both"></div> 
		</div>
		<div class="content">
			<div class="article">文章</div>
			<?php
				showtitle();
			?>
			<div style="clear:both"></div> 
		</div>
		<?php
			include("foot2.php");
		?>
	</div>
	</div>
	<?php
		include ("foot.php");
	?>
</body>
</html>
