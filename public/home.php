<?php

	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	
	mysql_connect("localhost","root","");
	mysql_select_db("fantasy");
	
	$findTotal = mysql_query("select distinct m_id from manager_player");
	$Total = mysql_num_rows($findTotal);
	//echo "<h1 style='z-index=9999;'>Total = ".$Total."</h1>";
	$fetchLeaderboardQuery = "SELECT managerTeamName, managerName, teamValue, score1+score2+score3 SCORE from manager order by SCORE desc, teamValue LIMIT 0 , 10";
	$fetchLeaderBoard = mysql_query($fetchLeaderboardQuery) or die(mysql_error());
	$getStatMaxSelectedQuery = "SELECT playerName, teamName, ((COUNT( p_id ))/".$Total.")*100+' %' AS 'selectedBy' FROM player, manager_player, team WHERE pTeamId = teamId AND pid = p_id GROUP BY p_id ORDER BY COUNT( p_id ) DESC , value DESC LIMIT 0 , 5";
	$getStatMaxSelected = mysql_query($getStatMaxSelectedQuery) or die(mysql_error());
	
	$getStatMostValuedQuery = "SELECT playerName, value,score1+score2+score3 SCORE, teamName FROM player, team WHERE pTeamId = teamId ORDER BY SCORE DESC LIMIT 0 , 5";
	$getStatMostValued = mysql_query($getStatMostValuedQuery) or die(mysql_error());
	
	$getDreamGK = mysql_query("SELECT playerName, pTeamId, score1+score2+score3 as SCORE from player where position='gk' order by 'SCORE' desc, value desc LIMIT 0 , 1");
	while($getGK = mysql_fetch_array($getDreamGK))
	{
		$GKName = $getGK['playerName'];
		$GKTeam = $getGK['pTeamId'];
		$GKPoints = $getGK['SCORE'];
	}
	$getDreamDF = mysql_query("SELECT playerName, pTeamId, score1+score2+score3 as SCORE from player where position='df' order by 'SCORE' desc, value desc LIMIT 0 , 2");
	$countDF = 0;
	while($getDF = mysql_fetch_array($getDreamDF))
	{
		$DFName[$countDF] = $getDF['playerName'];
		$DFTeam[$countDF] = $getDF['pTeamId'];
		$DFPoints[$countDF] = $getDF['SCORE'];
		$countDF = $countDF + 1;
	}
	$getDreamFW = mysql_query("SELECT playerName, pTeamId, score1+score2+score3 as SCORE from player where position='fw' order by 'SCORE' desc, value desc LIMIT 0 , 4");
	$countFW = 0;
	while($getFW = mysql_fetch_array($getDreamFW))
	{
		$FWName[$countFW] = $getFW['playerName'];
		$FWTeam[$countFW] = $getFW['pTeamId'];
		$FWPoints[$countFW] = $getFW['SCORE'];
		$countFW = $countFW + 1;
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Fantasy Football League</title>
		<script src="jquery-1.10.2.min.js"></script>
		<script src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/fonts.css"/>
		<link rel="stylesheet" href="jquery-ui-1.10.3.custom/css/smoothness/jquery-ui-1.10.3.custom.min.css" />
		<script type="text/javascript">
					$(document).ready(function() {
						
						$("#matchday").accordion({collapsible:true, active:false});
						
					});
					
		</script>
	</head>
	<style>
		
		html,body{
			background: url("wallpaper.png");
			color:#dfdfdf;
			min-height:100%;
			padding:0;
			margin:0px 10px;
			position:relative;
			}
		#header{
			color:white;
			
			font: 20px Syncopate;			
			position:relative;
			top:0px;
			width:100%;
		}
		a:visited, a:link, a:active
		{
			text-decoration: none;
			color:#DFDFDF;
			padding:0px 10px 0px 10px;
			margin:0px 20px 0px 20px;
		}
		a:hover
		{
			text-shadow:0 0 8px #ffffff;
			color:white;
		}
		
		#logout:hover{
			text-shadow:0 0 8px red;
			color:#ffeeee;
		}
		.headerElement{
			display:inline;	
		}
		td{padding:2px 5px 2px 5px;color:#dfdfdf;}
	</style>
	
	<body>
		<center><img src="snuLogo.png"></center>
		<center><div id="header">
		
			
			<a href="points.php" class="headerElement">POINTS</a>
			<a href="team.php" class="headerElement">MY TEAM</a>
			<a href="#" class="headerElement">HOW TO PLAY</a>
			<a href="#" class="headerElement">ABOUT US</a>
			<a href="edit.php" class="headerElement">ACCOUNT</a>
			<a href="logout.php" class="headerElement" id="logout">LOG OUT</a>
		</div></center>
		<br><br>
		<span style="font:40px Philosopher;color:#dfdfdf;text-shadow:0 0 8px #dfdfdf;margin-left:10px;">Welcome back, <?php echo $_SESSION['managerName'];?>!</span><br><br><br><br>
		<div id="matchday" align="left" style="float:right;font-family: Philosopher;color:#dfdfdf;margin:10px;width:400px;">
			<span>Matchday 1 - Monday, 28th October</span>
				<div style="background:url('wallpaper2.png');"><table border="1" width="auto"><tr align="center"><td>Titans</td><td>0-0</td><td>Shadows</td></tr><tr align="center"><td>Supersonics</td><td>1-0</td><td>Flying Dutchmen</td></tr></table></div>
			<span>Matchday 2 - Tuesday, 29th October</span>
				<div style="background:url('wallpaper2.png');"><table border="1" width="auto"><tr align="center"><td>Sky Larks</td><td>v/s</td><td>Silver Hawks</td></tr><tr align="center"><td>Flying Dutchmen</td><td>v/s</td><td>Shadows</td></tr></table></div>
			<span>Matchday 3 - Wednesday, 30th OCtober</span>
				<div style="background:url('wallpaper2.png');"><table border="1" width="auto"><tr align="center"><td>Silver Hawks</td><td>v/s</td><td>Titans</td></tr><tr align="center"><td>Sky Larks</td><td>v/s</td><td>Supersonics</td></tr></table></div>
			<span>Matchday 4 - Thursday, 31st October</span>
				<div style="background:url('wallpaper2.png');"><table border="1" width="auto"><tr align="center"><td>Shadows</td><td>v/s</td><td>Silver Hawks</td></tr><tr align="center"><td>Flying Dutchmen</td><td>v/s</td><td>Sky Larks</td></tr></table></div>
			<span>Matchday 5 - Tuesday, 5th November</span>
				<div style="background:url('wallpaper2.png');"><table border="1" width="auto"><tr align="center"><td>Titans</td><td>v/s</td><td>Supersonics</td></tr><tr align="center"><td>Shadows</td><td>v/s</td><td>Sky Larks</td></tr></table></div>
			<span>Matchday 6 - Wednesday, 6th November</span>
				<div style="background:url('wallpaper2.png');"><table border="1" width="auto"><tr align="center"><td>Silver Hawks</td><td>v/s</td><td>Supersonics</td></tr><tr align="center"><td>Titans</td><td>v/s</td><td>Flying Dutchmen</td></tr></table></div>
			<span>Matchday 7 - Thursday, 7th November</span>
				<div style="background:url('wallpaper2.png');"><table border="1" width="auto"><tr align="center"><td>Shadows</td><td>v/s</td><td>Supersonics</td></tr><tr align="center"><td>Sky Larks</td><td>v/s</td><td>Titans</td></tr><tr align="center"><td>Flying Dutchmen</td><td>v/s</td><td>Silver Hawks</td></tr></table></div>
			<span>PlayOffs - Friday, 8th November</span>
			<div style="background:url('wallpaper2.png');"><table border="1" width="auto"><tr align="center"><td>Semi-Final 1</td></tr><tr align="center"><td>Eliminator</td></tr></table></div>
			<span>PlayOffs - Saturday, 9th November</span>
			<div style="background:url('wallpaper2.png');"><table border="1" width="auto"><tr align="center"><td>Semi-Final 2</td></table></div>
			<span>FINAL - Monday, 11th November</span>
		</div>
		
		<div id="leaderboard" style="display:inline-block;margin:10px;font: 18px Philosopher;color:#dfdfdf;background:url('wallpaper2.png');">
			
			<table border="1">
				<tr>
					<td colspan="5" align="center" valign="center" style="font-size:28px;text-shadow:0 0 5px #dfdfdf;padding-bottom:5px;padding-top:5px;">FANTASY LEADERBOARD</td>
				</tr>
				<tr>
					<th style="padding:5px;" align="center" valign="center">#</th><th style="padding:5px;" align="center" valign="center">TEAM NAME</th><th style="padding:5px;" align="center" valign="center">MANAGER NAME</th><th style="padding:5px;" align="center" valign="center">TEAM VALUE</th><th style="padding:5px;" align="center" valign="center">OVERALL SCORE</th>
				</tr>
				<?php
					$rank = 1;
					while($leader = mysql_fetch_array($fetchLeaderBoard))
					{
						echo "<tr>";
							echo '<td>'.$rank.'</td><td>'.$leader['managerTeamName'].'</td><td>'.$leader['managerName'].'</td><td>'.$leader['teamValue'].'</td><td>'.$leader['SCORE'].'</td>';
						echo "</tr>";
						$rank = $rank + 1;
					}
				?>
			</table>
			
		</div>
		<br><br>
		<span style="margin-top:20px;font-size:28px;text-shadow:0 0 5px #dfdfdf;padding-bottom:5px;padding-top:5px;">DREAM TEAM</span><br>
		<div id="pitch" style="background:url('pitch.jpg') no-repeat; margin-left:10px; width:717px; height:478px;box-shadow: 0 0 25px 1px #dfdfdf;border:solid 1px #dfdfdf;">
		<div id="team" style="display:-webkit-flex; font:bold 15px Helvetica;">
			<div id="gk" style="width:150px;position:relative;top:190px;left:10px;"><img src="kit/<?php echo $GKTeam;?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $GKPoints." - ". $GKName;?></div>
			<div id="fw1" style="width:150px;position:relative;top:30px;left:300px;"><img src="kit/<?php echo $FWTeam[0];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $FWPoints[0]." - ". $FWName[0];?></div>
			<div id="fw2" style="width:150px;position:relative;top:190px;left:110px;"><img src="kit/<?php echo $FWTeam[1];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $FWPoints[1]." - ". $FWName[1];?></div>
			<div id="fw3" style="width:150px;position:relative;top:350px;left:98px;"><img src="kit/<?php echo $FWTeam[2];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $FWPoints[2]." - ". $FWName[2];?></div>
			<div id="fw4" style="width:150px;position:relative;top:190px;left:100px;"><img src="kit/<?php echo $FWTeam[3];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $FWPoints[3]." - ". $FWName[3];?></div>
			<div id="df1" style="width:150px;position:relative;top: 100px;right:325px;"><img src="kit/<?php echo $DFTeam[0];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $DFPoints[0]." - ". $DFName[0];?></div>
			<div id="df2" style="width:150px;position:relative;top: 280px;right: 428px;"><img src="kit/<?php echo $DFTeam[1];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $DFPoints[1]." - ". $DFName[1];?></div>
			
		</div>
		</div>
		<br><br>		
		
		<div id="mostSelected" style="display:inline-block;margin:10px;font: 18px Philosopher;color:#dfdfdf;background:url('wallpaper2.png');">
			
			<table border="1">
				<tr>
					<td colspan="4" align="center" valign="center" style="font-size:28px;text-shadow:0 0 5px #dfdfdf;padding-bottom:5px;padding-top:5px;">MOST SELECTED PLAYERS</td>
				</tr>
				<tr>
					<th style="padding:5px;" align="center" valign="center">#</th><th style="padding:5px;" align="center" valign="center">NAME</th><th style="padding:5px;" align="center" valign="center">TEAM</th><th style="padding:5px;" align="center" valign="center">SELECTED BY</th>
				</tr>
				<?php
					$rank = 1;
					while($maxSelected = mysql_fetch_array($getStatMaxSelected))
					{
						echo "<tr>";
							echo '<td>'.$rank.'</td><td>'.$maxSelected['playerName'].'</td><td>'.$maxSelected['teamName'].'</td><td>'.$maxSelected['selectedBy'].'% </td>';
						echo "</tr>";
						$rank = $rank + 1;
					}
				?>
			</table>
			
		</div>
		
		<div id="mostValued" style="display:inline-block;margin:10px;font: 18px Philosopher;color:#dfdfdf;background:url('wallpaper2.png');">
			
			<table border="1" >
				<tr>
					<td colspan="5" align="center" valign="center" style="font-size:28px;text-shadow:0 0 5px #dfdfdf;padding-bottom:5px;padding-top:5px;">MOST VALUABLE PLAYERS</td>
				</tr>
				<tr>
					<th style="padding:5px;" align="center" valign="center">#</th><th style="padding:5px;" align="center" valign="center">NAME</th><th style="padding:5px;" align="center" valign="center">TEAM</th><th style="padding:5px;" align="center" valign="center">VALUE</th><th style="padding:5px;" align="center" valign="center">SCORE</th>
				</tr>
				<?php
					$rank = 1;
					while($mostValued = mysql_fetch_array($getStatMostValued))
					{
						echo "<tr>";
							echo '<td>'.$rank.'</td><td>'.$mostValued['playerName'].'</td><td>'.$mostValued['teamName'].'</td><td>'.$mostValued['value'].'</td><td>'.$mostValued['SCORE'].'</td>';
						echo "</tr>";
						$rank = $rank + 1;
					}
				?>
			</table>
			
		</div>
		
		<br><br><br><br>
		
		
		
	</body>

</html>