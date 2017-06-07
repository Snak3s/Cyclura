<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<?php
		include ("script3.php");
		isinstalled();
	?>
	<link rel="stylesheet" type="text/css" href="/style3.css">
	<script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
	<script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$']]}});</script>
	<title>
		安装 = Snakes =
	</title>
</head>
<body style="margin: 0px;">
	<div class="page">
		<div class="title">
			Cyclura 1
		</div>
		<div class="content">
			<div class="article">
				安装
			</div>
			<div class="text">
				<form method="post" action="checkdatabase.php">
					<table>
						<tr>
							<td>
								初始管理员用户名
							</td>
							<td>
								<input class="input" type="text" name="admin_name" value=""/>
							</td>
						</tr>
						<tr>
							<td>
								初始管理员密码
							</td>
							<td>
								<input class="input" type="password" name="admin_password" value=""/>
							</td>
						</tr>
						<tr>
							<td>
								MySQL数据库名
							</td>
							<td>
								<input class="input" type="text" name="database_name" value=""/>
							</td>
						</tr>
						<tr>
							<td>
								MySQL用户名
							</td>
							<td>
								<input class="input" type="text" name="user_name" value=""/>
							</td>
						</tr>
						<tr>
							<td>
								MySQL密码
							</td>
							<td>
								<input class="input" type="password" name="user_password" value=""/>
							</td>
						</tr>
						<tr>
							<td>
								数据库主机
							</td>
							<td>
								<input class="input" type="text" name="database_host" value=""/>
							</td>
						</tr>
					</table>
					<button class="button with-border" type="submit">安装</button>
					<?php
						if ($_GET["error"])
							echo "<div class=\"button\">连接数据库时发生错误。</div>";
						if ($_GET["readonly"])
							echo "<div class=\"button\">配置文件不可写，请检查权限设置。</div>";
					?>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
