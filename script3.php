<?php
	require("parsedown.php");
	function connect()
	{
		$mysqli=new mysqli();
		$mysqli->connect(constant("dbhost"),constant("dbuser"),constant("dbpsw"),constant("dbname"));
		$mysqli->query("set names utf8;");
		return $mysqli;
	}
	function islogin()
	{
		if (!$_SESSION["account"])
			return false;
		return true;
	}
	function checklogin()
	{
		if (!$_SESSION["account"])
			header("location:login.php");
	}
	function isadmin($user)
	{
		$mysqli=connect();
		$rs=$mysqli->query("select * from admin where account=\"$user\";");
		$num=mysqli_num_rows($rs);
		$mysqli->close();
		return $num>0;
	}
	function checkadmin()
	{
		if (!isadmin($_SESSION["account"]))
			header("location:/");
	}
	function isinstalled()
	{
		if (file_exists("settings.php"))
			header("location:/");
	}
	function isuninstall()
	{
		if (!file_exists("settings.php"))
			header("location:install.php");
	}
	function login($user,$psw)
	{
		$user=addslashes($user);
		$mysqli=connect();
		$rs=$mysqli->query("select * from user where account=\"$user\";");
		$num=mysqli_num_rows($rs);
		if (!$num)
			return "用户不存在。";
		$row=$rs->fetch_array();
		if ($row["password"]==md5($psw))
		{
			$_SESSION["account"]=$row["account"];
			return;
		}
		return "用户名与密码不匹配。";
		$mysqli->close();
	}
	function logout()
	{
		$_SESSION["account"]="";
		header("location:login.php");
	}
	function signup($user,$psw,$repeatpsw)
	{
		$mysqli=connect();
		$rs=$mysqli->query("select * from user where account=\"$user\";");
		$num=mysqli_num_rows($rs);
		if ($num)
		{
			header("location:signup.php?user=1");
			return;
		}
		$user=addslashes($user);
		if (!str_replace(" ","",$user))
		{
			header("location:signup.php?user=2");
			return;
		}
		if ($psw!=$repeatpsw)
		{
			header("location:signup.php?password=1");
			return;
		}
		$mysqli->query("insert into user (account,password) values (\"$user\",\"".md5($psw)."\");");
		login($user,$psw);
		header("location:/");
		$mysqli->close();
	}
	function showposts()
	{
		$mysqli=connect();
		$rs=$mysqli->query("select * from blog order by id desc;");
		$num=mysqli_num_rows($rs);
		if (!$num)
		{
			echo "<div class=\"content\">\n糟糕……好像一点东西都没有呢……\n</div>\n";
			$mysqli->close();
			return;
		}
		$row=$rs->fetch_array();
		while ($row)
		{
			$Parsedown=new parsedown();
			$i=$row["id"];
			echo "<div class=\"content\">\n";
			echo "<a href=\"/detail/$i\">\n<div class=\"article\">\n".urldecode($row["title"])."\n</div>\n</a>\n";
			echo "<div class=\"time\">\n".$row["time"]." | ".$row["account"]."\n</div>\n";
			echo "<div class=\"text\" id=\"show$i\">\n".$Parsedown->text(strstr($row["body"],"<:more:>",true).(strpos($row["body"],"<:more:>")?"[阅读更多>>](/detail/$i)":$row["body"]))."\n</div>\n";
			echo "</div>\n";
			$row=$rs->fetch_array();
		}
		$mysqli->close();
	}
	function showcomment($id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		$rs=$mysqli->query("select * from comment where postid=$id order by id desc;");
		$num=mysqli_num_rows($rs);
		if (!$num)
		{
			echo "<div class=\"content\">\n这里还没有留言，快来留一条吧～\n</div>\n";
			$mysqli->close();
			return;
		}
		$row=$rs->fetch_array();
		while ($row)
		{
			$Parsedown=new parsedown();
			$i=$row["id"];
			echo "<div class=\"content content-min\">\n";
			if (isadmin($_SESSION["account"]))
				echo "<a href=\"/deletecomment.php?id=$i\">\n<div class=\"button with-border\">\n删除\n</div>\n</a>\n";
			echo "<div class=\"article\">\n";
			echo $row["account"]."\n</div>\n";
			echo "<div class=\"time\">\n".$row["time"]."\n</div>\n";
			echo "<div class=\"comment\" id=\"show$i\">\n".$Parsedown->text($row["body"])."\n</div>\n";
			echo "</div>\n";
			$row=$rs->fetch_array();
		}
		$mysqli->close();
	}
	function showuser()
	{
		$mysqli=connect();
		$rs=$mysqli->query("select * from user;");
		$row=$rs->fetch_array();
		while ($row)
		{
			$trs=$mysqli->query("select * from admin where account=\"".$row["account"]."\";");
			$num=mysqli_num_rows($trs);
			if (!$num)
				echo "<a href=\"add.php?id=".$row["userid"]."\">\n<div class=\"button with-border\">+ | ".$row["account"]."</div>\n</a>\n";
			$row=$rs->fetch_array();
		}
		$mysqli->close();
	}
	function showtitle()
	{
		$mysqli=connect();
		$rs=$mysqli->query("select * from blog order by id desc;");
		$num=mysqli_num_rows($rs);
		if (!$num)
		{
			echo "糟糕……好像一点东西都没有呢……";
			return;
		}
		$row=$rs->fetch_array();
		while ($row)
		{
			$i=$row["id"];
			echo "<a href=\"detail.php?id=$i\">\n<div class=\"content-min\">\n<div class=\"article\">".urldecode($row["title"])."</div><div class=\"time\">".$row["time"]." | ".$row["account"]."\n</div></div>\n</a>\n";
			$row=$rs->fetch_array();
		}
		$mysqli->close();
	}
	function addadmin($id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		checklogin();
		checkadmin();
		$rs=$mysqli->query("select account from user where userid=$id;");
		$row=$rs->fetch_array();
		$mysqli->query("insert into admin (account) values (\"".$row["account"]."\");");
		header("location:admin.php");
		$mysqli->close();
	}
	function moveadmin($id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		checklogin();
		checkadmin();
		if ($id!=1)
			$mysqli->query("delete from admin where id=$id;");
		header("location:admin.php");
		$mysqli->close();
	}
	function showadmin()
	{
		$mysqli=connect();
		$rs=$mysqli->query("select * from admin;");
		$row=$rs->fetch_array();
		while ($row)
		{
			if ($row["id"]==1)
				echo "<div class=\"button with-border\">站长 | ".$row["account"]."</div>\n";
			else
				echo "<a href=\"move.php?id=".$row["id"]."\">\n<div class=\"button with-border\">- | ".$row["account"]."</div>\n</a>\n";
			$row=$rs->fetch_array();
		}
		$mysqli->close();
	}
	function post($title,$text)
	{
		$mysqli=connect();
		if (!islogin())
		{
			echo "身份校验失效啦，重新登陆试试吧。";
			return;
		}
		checkadmin();
		if (!$title)
		{
			echo "标题不能为空。";
			return;
		}
		if (!$text)
		{
			echo "内容不能为空。";
			return;
		}
		$text=str_replace("\\","\\\\",$text);
		$text=str_replace("\"","\\\"",$text);
		$mysqli->query("insert into blog (time,account,title,body) values (\"".date("y/m/d H:i:s")."\",\"".$_SESSION["account"]."\",\"$title\",\"$text\");");
		$mysqli->close();
	}
	function modify($title,$text,$id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		checklogin();
		checkadmin();
		if (!$title)
		{
			echo "标题不能为空。";
			return;
		}
		if (!$text)
		{
			echo "内容不能为空。";
			return;
		}
		$text=str_replace("\\","\\\\",$text);
		$text=str_replace("\"","\\\"",$text);
		$mysqli->query("update blog set time=\"".date("y/m/d H:i:s")."\",account=\"".$_SESSION["account"]."\",title=\"$title\",body=\"$text\" where id=$id;");
		$mysqli->close();
	}
	function deletepost($id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		checklogin();
		checkadmin();
		$mysqli->query("delete from blog where id=$id;");
		header("location:/");
		$mysqli->close();
	}
	function deletecomment($id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		checklogin();
		checkadmin();
		$mysqli->query("delete from comment where id=$id;");
		header("location:/");
		$mysqli->close();
	}
	function comment($user,$text,$id)
	{
		if (!is_numeric($id))
			return;
		$user=str_replace("<","&lt;",$user);
		$text=str_replace("<","&lt;",$text);
		$mysqli=connect();
		if (!$user)
		{
			echo "昵称不能为空。";
			return;
		}
		if (!$text)
		{
			echo "内容不能为空。";
			return;
		}
		$text=str_replace("\\","\\\\",$text);
		$text=str_replace("\"","\\\"",$text);
		$mysqli->query("insert into comment (time,account,body,postid) values (\"".date("y/m/d H:i:s")."\",\"".$user."\",\"$text\",$id);");
		$mysqli->close();
	}
	function title($id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		$rs=$mysqli->query("select title from blog where id=\"$id\";");
		$row=$rs->fetch_array();
		$mysqli->close();
		return $row["title"];
	}
	function timepost($id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		$rs=$mysqli->query("select * from blog where id=\"$id\";");
		$row=$rs->fetch_array();
		$mysqli->close();
		return $row["time"]." | Posted by ".$row["account"];
	}
	function mdcode($id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		$rs=$mysqli->query("select body from blog where id=\"$id\";");
		$row=$rs->fetch_array();
		$mysqli->close();
		return str_replace("<","&lt;",$row["body"]);
	}
	function mdtext($id)
	{
		if (!is_numeric($id))
			return;
		$mysqli=connect();
		$rs=$mysqli->query("select body from blog where id=\"$id\";");
		$row=$rs->fetch_array();
		$mysqli->close();
		$Parsedown=new parsedown();
		return $Parsedown->text(str_replace("<:more:>","",$row["body"]));
	}
	function showuploaded()
	{
		if (!isadmin($_SESSION["account"]))
			return;
		$dir=opendir("upload/");
		if (!$dir)
		{
			echo "出错啦！";
			return;
		}
		while (($file=readdir($dir))!==false)
			if ($file!="."&&$file!="..")
				echo "<p>".$file."</p>";
		closedir($dir);
	}
	include("settings.php");
	session_start();
?>
