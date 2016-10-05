<?php

	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	
	else if($_SESSION['mid']!=1) header('Location: index.php');
	
	else if(!isset($_POST['teamID'])) header('Location: playerPoints.php');
	
	else if($_SESSION['mid']==1)
	{
		echo "<!DOCTYPE html>
		<html>
		<head></head>
		<body><br><br><br><br><br>";
	
		mysql_connect("localhost","root","");
		mysql_select_db("fantasy");
		
		$players = mysql_query("select playerName, score2 from player where pTeamId =".$_POST['teamID']."") or die(mysql_error());
		echo "<form action='playerPointsFinal.php' method='POST'>";
		while($player = mysql_fetch_array($players))
		{
			echo "<input type='text' value='".$player['playerName']."' name='player[]'><input type='text' value='".$player['score2']."' name='points[]'><br>";
		}
		echo "<input type='submit'>";
		echo "</form></body></html>";
	}
 ?>