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
		上传 = Snakes =
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
			<div class="article">
				上传
			</div>
			<div class="text">
				<form name='upload' method="POST" action='tryupload.php' enctype="multipart/form-data">
					<p>Filename: </p>
					<input type='file' name='file' value=''/>
					<p>
						<?php
							if ($_GET['file'])
								echo "这个文件似乎有问题……没法上传诶？";
							if ($_GET['exist'])
								echo "诶……已经有同名文件啦！改下文件名试试吧？";
						?>
					</p>
					<p>
						<input type='submit' name='sub' value='上传' class="button with-border"/>
						<div class="clear"></div>
					</p>
				</form>
			</div>
		</div>
		<div class="content">
			<div class="article">
				已上传文件
			</div>
			<div class="text">
				<?php
					showuploaded();
				?>
			</div>
		</div>
		<?php
			include ("foot2.php");
		?>
	</div>
</body>
</html>
