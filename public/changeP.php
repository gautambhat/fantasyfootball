<?php

	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	if(!(isset($_POST['oldP']) && isset($_POST['newP']) && isset($_POST['newPC']) && isset($_POST['teamName'])))
	{
		header("Location: edit.php");
	}
	mysql_connect("localhost","root","");
	mysql_select_db("fantasy");
	$sqlTemp = "select password from manager where mid=".$_SESSION['mid'];
	$getOldP = mysql_query($sqlTemp);
	while($OldP = mysql_fetch_array($getOldP))
	$Old = $OldP['password'];
	if(strcmp($Old,$_POST['oldP'])!=0)
	{
		echo "<br><br><h3>Old Password Incorrect. Password has not been changed. <a href='edit.php'>Try again?</a><h3>";
	}
	else if(strcmp($_POST['newP'],$_POST['newPC'])!=0)
	{
		echo "<br><br><h3>Failed to confirm new password. Make sure you have entered password and confirmed it correctly. <a href='edit.php'>Try again?</a></h3>";
	}
	else{
		mysql_query("update manager set password='".$_POST['newP']."' where mid=".$_SESSION['mid']."") or die(mysql_error());
		mysql_query("update manager set managerTeamName='".addslashes($_POST['teamName'])."' where mid=".$_SESSION['mid']."") or die(mysql_error());
		header("Location: home.php");
	}
?>