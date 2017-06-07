<?php
	include ("script3.php");
	if (isadmin($_SESSION["account"]))
		if($_FILES["file"]["error"]>0)
			header("location:upload.php?file=1");
		else
		{
			if (file_exists("upload/".$_FILES["file"]["name"]))
				header("location:upload.php?exist=1");
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
				header("location:finishupload.php?upload=".$_FILES["file"]["name"]."&type=".$_FILES["file"]["type"]."&size=".($_FILES["file"]["size"]/1024)."kb&store=".$_FILES["file"]["name"]);
			}
		}
	else
		header("location:login.php");
?>
