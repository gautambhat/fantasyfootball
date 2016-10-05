<?php 

	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	
	else if($_SESSION['mid']!=1) echo "<h1>Unauthorized access.</h1>";
	
	else if($_SESSION['mid']==1)
	{
	
		mysql_connect("localhost","root","");
		mysql_select_db("fantasy");
		
		$collectMidQuery = mysql_query("select distinct m_id from manager_player where m_id != 1") or die(mysql_error());
		
		while($collectMid = mysql_fetch_array($collectMidQuery))
		{
			$midThis = $collectMid['m_id'];
			$getPointQuery = mysql_query("select score2 from player, manager_player where m_id=".$midThis." and pid=p_id")or die(mysql_error());
			$getCaptainPointsQuery = mysql_query("select score2 from player, captain where m_id=".$midThis." and pid=p_id")or die(mysql_error());
			$overallScore = 0;
			while($getPoint=mysql_fetch_array($getPointQuery))
			{
				$overallScore = $overallScore + $getPoint['score2'];
			}
			while($getCaptainPoints = mysql_fetch_array($getCaptainPointsQuery))
			{
				$overallScore = $overallScore + $getCaptainPoints['score2'];
			}
			
			mysql_query("update manager set score2 = ".$overallScore." where mid=".$midThis."") or die(mysql_error());
		
		
		
		}
	
	
		echo "<h2>Points updated for all managers. Return <a href='home.php'>here</a>.</h2>";
	}

?>