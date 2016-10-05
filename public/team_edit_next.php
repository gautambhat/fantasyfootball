<?php
	
	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	if(!isset($_POST["player"]))
		header("Location: team.php");
	if(!isset($_POST["captain"]))
		header("Location: team.php");
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("fantasy") or die(mysql_error());
	
	$player = $_POST['player'];
	$getPlayerIDs = mysql_query("select pid,value from player where playerName in ('".$player[0]."','".$player[1]."','".$player[2]."','".$player[3]."','".$player[4]."','".$player[5]."','".$player[6]."')");
	$getCaptainID = mysql_query("select pid from player where playerName='".$_POST['captain']."'");
	$count = 0;
	$teamValue = 0;
	while($playerIDs = mysql_fetch_array($getPlayerIDs))
	{
		$ID[$count] = $playerIDs['pid'];
		$count = $count+1;
		$teamValue = $teamValue + $playerIDs['value'];
	}
	$captainID = mysql_fetch_array($getCaptainID);
	
	$checkTeamExists = mysql_query("select p_id from manager_player where m_id=".$_SESSION['mid']."") or die(mysql_error()); 
	$checkCaptainExists = mysql_query("select p_id from captain where m_id=".$_SESSION['mid']."") or die(mysql_error());
	if(mysql_num_rows($checkTeamExists)>0 || mysql_num_rows($checkCaptainExists)>0)
	{
		$tempQuery1 = "DELETE from manager_player where m_id=".$_SESSION['mid'];
			mysql_query($tempQuery1) or die(mysql_error());
		$tempQuery2 = "DELETE from captain where m_id=".$_SESSION['mid'];
			mysql_query($tempQuery2) or die(mysql_error());
	}
	foreach($ID as $i)
	mysql_query("insert into manager_player values(".$_SESSION['mid'].",".$i.")") or die(mysql_error());
	mysql_query("insert into captain values(".$_SESSION['mid'].",".$captainID[0].")") or die(mysql_error());
	$teamQuery3 = "update manager set teamValue=".$teamValue." where mid=".$_SESSION['mid'];
		mysql_query($teamQuery3) or die(mysql_error());
	
	
	header("Location: team.php");

?>