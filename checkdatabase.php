<?php
	header("content-type:text/html;charset=utf-8;");
	$dbname=$_POST["database_name"];
	$dbuser=$_POST["user_name"];
	$dbpsw=$_POST["user_password"];
	$dbhost=$_POST["database_host"];
	$admin=$_POST["admin_name"];
	$adminpsw=$_POST["admin_password"];
	$mysqli=new mysqli();
	$mysqli->connect($dbhost,$dbuser,$dbpsw);
	if ($mysqli)
	{
		$settings=fopen("settings.php","w");
		if ($settings)
		{
			$mysqli->query("set names utf8;");
			$mysqli->query("create database $dbname;");
			$mysqli->select_db($dbname);
			$mysqli->query("create table user (userid int (8) not null primary key auto_increment, account char (50) not null, password char(32) not null);");
			$mysqli->query("alter table user modify account char(50) character set utf8;");
			$mysqli->query("create table admin (id int (8) not null primary key auto_increment, account char (50) not null);");
			$mysqli->query("alter table admin modify account char(50) character set utf8;");
			$mysqli->query("create table blog (id int (8) not null primary key auto_increment, time char (50) not null, account char(50) not null, title text not null, body text not null);");
			$mysqli->query("alter table blog modify account char(50) character set utf8;");
			$mysqli->query("alter table blog modify title text character set utf8;");
			$mysqli->query("alter table blog modify body text character set utf8;");
			$mysqli->query("create table comment (id int (8) not null primary key auto_increment, time char (50) not null, account char(50) not null, body text not null, postid int (8) not null);");
			$mysqli->query("alter table comment modify account char (50) character set utf8;");
			$mysqli->query("alter table comment modify body text character set utf8;");
			$mysqli->query("insert into user (account,password) values (\"$admin\",\"".md5($adminpsw)."\");");
			$mysqli->query("insert into admin (account) values (\"$admin\");");
			$mysqli->query("insert into blog (time,account,title,body) values (\"".date("y/m/d H:i:s")."\",\"$admin\",\"Hello World! \",\"Welcome to **Cyclura**. Enjoy your new blogging life! \");");
			fwrite($settings,"<?php\n");
			fwrite($settings,"	define(\"dbname\",\"$dbname\");\n");
			fwrite($settings,"	define(\"dbuser\",\"$dbuser\");\n");
			fwrite($settings,"	define(\"dbpsw\",\"$dbpsw\");\n");
			fwrite($settings,"	define(\"dbhost\",\"$dbhost\");\n");
			fwrite($settings,"?>");
			fclose($settings);
			header("location:/");
		}
		else
			header("location:install.php?readonly=1");
	}
	else
		header("location:install.php?error=1");
?>
