<?php

	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');


	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("fantasy") or die(mysql_error());
	$teamList = mysql_query("select playerName, pTeamId, value from player, manager_player where m_id=". $_SESSION['mid'] ." and pid=p_id order by position desc");
	$teamCaptain = mysql_query("select playerName from player, captain where m_id=". $_SESSION['mid'] ." and pid=p_id");
	$getTeamName = mysql_query("select managerTeamName from manager where mid = ".$_SESSION['mid']."");
	while($teamNameget = mysql_fetch_array($getTeamName))
	{
		$teamName = $teamNameget['managerTeamName'];
	}
	if(mysql_num_rows($teamCaptain)<=0 || mysql_num_rows($teamList)<=0)
	{
		header("Location: team_edit.php");
	}
	while($getCaptain1 = mysql_fetch_array($teamCaptain))
	$getCaptain = $getCaptain1['playerName'];
	$count = 0;
	$teamValue = 0;
	while($teamPlayer = mysql_fetch_array($teamList))
	{
		$player[$count]=$teamPlayer['playerName'];
		$teamValue= $teamValue + $teamPlayer['value'];
		$teamId[$count] = $teamPlayer['pTeamId'];
		$count = $count + 1;
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>My Team - Fantasy Football League</title>
		<script src="jquery-1.10.2.min.js"></script>
		<script src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/fonts.css"/>
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
		#button{font:25px Helvetica;
			width: auto;
			color:green;
			background-color:rgba(255,255,255,0.7);
			border-radius:10px;
			padding:10px 18px 10px 18px;
			text-decoration:none;
			outline : none;
			border:2px solid green;
		}
		#button:hover{color: white;}
		#lockdown{font:small-caps 25px Helvetica;
			width: auto;
			color:green;
			background-color:rgba(255,255,255,0.7);
			border-radius:10px;
			padding:10px 18px 10px 18px;
			text-decoration:none;
			outline : none;
			border:2px solid green;}
		
	</style>
	<body>
		<center><img src="snuLogo.png"></center>
		<center><div id="header">
		
			<a href="home.php" class="headerElement">HOME</a>
			<a href="points.php" class="headerElement">POINTS</a>
			<a href="#" class="headerElement">HOW TO PLAY</a>
			<a href="#" class="headerElement">ABOUT US</a>
			<a href="edit.php" class="headerElement">ACCOUNT</a>
			<a href="logout.php" class="headerElement" id="logout">LOG OUT</a>
		</div></center>
		<br><br>
		<span style="font:40px Amethysta;color:#dfdfdf;text-shadow:0 0 8px #dfdfdf;margin-left:10px;"><?php echo $teamName;?></span><br><br>
		<div id="pitch" style="float:left;background:url('pitch.jpg') no-repeat; margin-left:10px; width:717px; height:478px;box-shadow: 0 0 25px 1px #dfdfdf;border:solid 1px #dfdfdf;">
		<div id="team" style="display:-webkit-flex; font:bold 15px Helvetica;">
			<div id="gk" style="width:150px;position:relative;top:190px;left:10px;"><img src="kit/<?php echo $teamId[0];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $player[0];?></div>
			<div id="fw1" style="width:150px;position:relative;top:30px;left:300px;"><img src="kit/<?php echo $teamId[1];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $player[1];?></div>
			<div id="fw2" style="width:150px;position:relative;top:190px;left:110px;"><img src="kit/<?php echo $teamId[2];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $player[2];?></div>
			<div id="fw3" style="width:150px;position:relative;top:350px;left:98px;"><img src="kit/<?php echo $teamId[3];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $player[3];?></div>
			<div id="fw4" style="width:150px;position:relative;top:190px;left:100px;"><img src="kit/<?php echo $teamId[4];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $player[4];?></div>
			<div id="df1" style="width:150px;position:relative;top: 100px;right:325px;"><img src="kit/<?php echo $teamId[5];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $player[5];?></div>
			<div id="df2" style="width:150px;position:relative;top: 280px;right: 428px;"><img src="kit/<?php echo $teamId[6];?>.png" style="height:auto;width:auto;max-height:73px;"><?php echo $player[6];?></div>
			
		</div>
		</div>
		<br><br>
		<center><div style="font:bold 25px Amethysta;margin:20px;">Team Value : <?php echo $teamValue;?> Points<br><br><br>Captain : <?php echo $getCaptain; ?><br></div>
		<br><br><a id="button" href="team_edit.php" title="Click here to pick team again">Pick Again</a><!--<span id="lockdown">Lockdown until next Transfer Window</span>--></center>

		<br><br><br><br><br><br><br><br><br><br><br><br>
		
		
		
	</body>

</html>