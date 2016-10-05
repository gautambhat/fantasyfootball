<?php

	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	
	else if($_SESSION['mid']!=1) header('Location: index.php');
	
	if(!(isset($_POST['player']) && isset($_POST['points']))) header('Location: playerPoints.php');
	
	if(sizeof($_POST['player'])!=sizeof($_POST['points'])) header("Location: playerPoints.php");
	
	if($_SESSION['mid']==1)
	{
		mysql_connect("localhost","root","");
		mysql_select_db("fantasy");
		
		$player = $_POST['player'];
		$points = $_POST['points'];
		
		$count = 0;
		while($count < sizeof($player))
		{
			mysql_query("update player set score2 = ".$points[$count]." where playerName='".$player[$count]."'");
			echo "<h3>".$player[$count]." - ".$points[$count]."</h3><br>";
			$count = $count + 1;
		}
	}
 ?>