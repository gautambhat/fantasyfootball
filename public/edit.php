<?php

	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	
	mysql_connect("localhost","root","");
	mysql_select_db("fantasy");
	
	$findTeamNameQuery = "Select managerTeamName from manager where mid=".$_SESSION['mid'];
	$findTeamName = mysql_query($findTeamNameQuery) or die(mysql_error());
	while($teamNameGet = mysql_fetch_array($findTeamName))
		$teamName = $teamNameGet['managerTeamName'];
	
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Gautam Bhat</title>
		<script src="jquery-1.10.2.min.js"></script>
		<script src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/fonts.css"/>
		<link rel="stylesheet" href="jquery-ui-1.10.3.custom/css/smoothness/jquery-ui-1.10.3.custom.min.css" />
		
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
		input{
			font-size:15px;
		}
				#button{font:17px Helvetica;
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
	</style>
	
	<body>
		<center><img src="snuLogo.png"></center>
		<center><div id="header">
		
			<a href="home.php" class="headerElement">HOME</a>
			<a href="#" class="headerElement">POINTS</a>
			<a href="team.php" class="headerElement">MY TEAM</a>
			<a href="#" class="headerElement">HOW TO PLAY</a>
			<a href="#" class="headerElement">ABOUT US</a>
			<a href="logout.php" class="headerElement" id="logout">LOG OUT</a>
		</div></center>
		<br><br>
		<span style="font:40px Philosopher;color:#dfdfdf;text-shadow:0 0 8px #dfdfdf;margin-left:10px;">EDIT YOUR PASSWORD AND TEAM NAME: </span><br><p>(Enter Your Current Password as your new password in case you only want to change Team Name.)</p><br><br>
		<form action="changeP.php" method="POST">
			<span style="font:17px Helvetica;">Team Name : </span><input type="text" size="20" name="teamName" value="<?php echo $teamName;?>" required><br>
			<span style="font:17px Helvetica;">Old Password : </span><input type="password" name="oldP" required><br>
			<span style="font:17px Helvetica;">New Password : </span><input type="password" name="newP" required><br>
			<span style="font:17px Helvetica;">Confirm New Password : </span><input type="password" name="newPC" required><br><br>
			<input id="button" type="submit" value="Update">
		</form>
	</body>
</html>