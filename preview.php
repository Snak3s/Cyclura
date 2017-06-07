<?php
	include ("script3.php");
	if (isadmin($_SESSION["account"]))
	{
		$Parsedown=new parsedown();
		$text=$_POST["markdown"];
		$text=str_replace("<:more:>","",$text);
		echo $Parsedown->text($text);
	}
?>
