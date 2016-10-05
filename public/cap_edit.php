<?php

	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("fantasy") or die(mysql_error());
	
	$player = $_POST['player'];
	if(sizeof($player)!=7)
		header("Location: team_edit.php");
	//$getPlayerIDs = mysql_query("select pid from player where playerName in ('".$player[0]."','".$player[1]."','".$player[2]."','".$player[3]."','".$player[4]."','".$player[5]."','".$player[6]."')");
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gautam Bhat</title>
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
		#listGK{float:left;font:17px Philosopher;margin-left:30px;}
		#listDF{float:left;font:17px Philosopher;}
		#listFW{float:left;font:17px Philosopher;margin-right:30px;}
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
		.gkListPlayer:hover{color:gold;}
		.dfListPlayer:hover{color:lime;}
		.fwListPlayer:hover{color:orange;}
	</style>
	
	<body>
		<center><div id="header">
		<center><img src="snuLogo.png"></center>
		
			<a href="home.php" class="headerElement">HOME</a>
			<a href="#" class="headerElement">POINTS</a>
			<a href="team.php" class="headerElement">MY TEAM</a>
			<a href="#" class="headerElement">HOW TO PLAY</a>
			<a href="#" class="headerElement">ABOUT US</a>
			<a href="logout.php" class="headerElement" id="logout">LOG OUT</a>
		</div></center>
		<br><br>
		
		<center><span title="Captains fetch twice as many points"style="font:30px Amethysta;color:#dfdfdf;text-shadow:0 0 8px #dfdfdf;margin-left:10px;">SELECT YOUR CAPTAIN</span></center>
			<br><br>
		
		<form action="team_edit_next.php" method="POST">
		<center>
		<div align="left" style="width:320px;font:small-caps 20px Syncopate;color:#dfdfdf;">
		<?php
			foreach($player as $i)
			{
				echo '<input type="hidden" name="player[]" value="'.$i.'">';
				echo '<label><input type="radio" required name="captain" value="'.$i.'">'.$i.'</label><br>';
			}
		?>
		</div>
		<br><br>
		<input type="submit" value="Proceed" title="Save Changes" id="button">
		</center>
		</form>
	</body>
</html>