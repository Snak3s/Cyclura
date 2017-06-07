<hr></hr>
<div class="content">
	<div style="float: left; width: 50%;">
		<img src="/favicon.ico" style="border-radius: 50%;"></img>
	</div>
	<div style="float: left; width: 50%;">
		<div class="text"><b>Snakes</b></div>
		<div class="time"><?php echo array_rand(array("嘿！嘿！嘿！我不是蛇！不是蛇！"=>"0","在Snakes被注册的情况下看见Snak3s也不奇怪。"=>"1","又名薮猫（Leptailurus serval mababiensis）。"=>"2","又名蓝岩鬣蜥（Cyclura lewisi）。"=>"3"),1);?></div>
		<div class="text">
			<p><a href="https://www.zhihu.com/people/snakes-49">Zhihu</a></p>
			<p><a href="https://github.com/Snak3s">Github</a></p>
		</div>
	</div>
	<div class="clear"></div>
</div>
<hr></hr>
<div id="foot" class="foot">
	<?php
		if ($_SESSION["account"])
			echo "<p>欢迎回来，".$_SESSION["account"]."。</p>";
	?>
	<p>
	<?php
		if ($_SESSION["account"])
			echo "<a href=\"/logout.php\">";
		else
			echo "<a href=\"/login.php\">";
	?>
		<?php
			if ($_SESSION["account"])
				echo "注销";
			else
				echo "登录";
		?>
	</a>
	/
	<?php
		if (isadmin($_SESSION["account"]))
		{
			echo "<a href=\"/admin.php\">管理</a> /\n";
			echo "<a href=\"/post.php\">发布新文章</a> /\n";
			echo "<a href=\"/upload.php\">上传</a> /\n";
		}
	?>
	<a href="http://talk.snakes.moe">Talk</a>
	/ 由 <a href="http://github.com/Snak3s/Cyclura">Cyclura</a> 强力驱动
	</p>
	<p>
		<a href="https://soha.moe">Soha</a> /
		<a href="http://ice1000.org">Ice 1000</a> /
		<a href="http://dram.cf">dramforever</a> /
		<a href="http://blog.xlightgod.com">Light God</a>
	</p>
</div>
