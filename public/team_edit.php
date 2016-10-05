<?php
	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("fantasy") or die(mysql_error());
	
	
	
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Pick Team</title>
		<script src="jquery-1.10.2.min.js"></script>
		<script src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/fonts.css"/>
		<script>
			$(document).ready(function(){
				
				
				var pointsLeft = 100;
				var gkCount = 0;
				var fwCount = 0;
				var dfCount = 0;
				var playerCount = 0;
				
				$('.gk').click(function() {
					
					if(parseInt(gkCount,10)>1 || parseInt(gkCount,10)<0)
						{
							alert("Error in page! Sorry for the inconvenience. Reloading...");
							location.reload();
						}
					if($(this).is(':checked'))
					{
						var playerCost = $(this).attr("title");
						if(parseInt(pointsLeft, 10) < parseInt(playerCost,10))
						{
							alert("NOT ENOUGH POINTS!");
							$(this).prop("checked", false);
							$(this).css('box-shadow','0 0 0 0 #dfdfdf');
						}
						else if(parseInt(gkCount,10) >= 1)
						{
							alert("MAXIMUM GOALKEEPERS SELECTED!");
							$(this).prop("checked", false);
							$(this).css('box-shadow','0 0 0 0 #dfdfdf');
						}
						else
						{
							$(this).css('box-shadow','0 0 10px 1px #dfdfdf');
							//pointsSpend = $(this).attr("value");
							pointsLeft = parseInt(pointsLeft, 10) - parseInt(playerCost, 10);
							document.getElementById("points").innerHTML = pointsLeft;
							gkCount = parseInt(gkCount, 10) + parseInt(1, 10);
							playerCount = parseInt(playerCount, 10) + parseInt(1, 10);
							//var idName = "player"+playerCount;
							//var playerName = $(this).attr("name");
							//document.getElementById(idName).setAttribute("value", playerName);
						}
						
					}
					else
					{	
						//var idName = "player"+playerCount;
						//document.getElementById(idName).removeAttribute("value");
						
						$(this).css('box-shadow','0 0 0 0 #dfdfdf');
						pointsReimburse = $(this).attr("title");
						pointsLeft = parseInt(pointsLeft, 10) + parseInt(pointsReimburse, 10);
						document.getElementById("points").innerHTML = pointsLeft;
						gkCount = parseInt(gkCount, 10) - parseInt(1, 10);
						playerCount = parseInt(playerCount, 10) - parseInt(1, 10);
						
					}
				});
				$('.df').click(function() {
				
					if(parseInt(dfCount,10)>2 || parseInt(dfCount,10)<0)
						{
							alert("Error in page! Sorry for the inconvenience. Reloading...");
							location.reload();
						}
					if($(this).is(':checked'))
					{
						var playerCost = $(this).attr("title");
						if(parseInt(pointsLeft, 10) < parseInt(playerCost,10))
						{
							alert("NOT ENOUGH POINTS!");
							$(this).prop("checked", false);
							$(this).css('box-shadow','0 0 0 0 #dfdfdf');
						}
						else if(parseInt(dfCount,10) >= 2)
						{
							alert("MAXIMUM DEFENDERS SELECTED!");
							$(this).prop("checked", false);
							$(this).css('box-shadow','0 0 0 0 #dfdfdf');
						}
						else
						{
							$(this).css('box-shadow','0 0 10px 1px #dfdfdf');
							//pointsSpend = $(this).attr("value");
							pointsLeft = parseInt(pointsLeft, 10) - parseInt(playerCost, 10);
							document.getElementById("points").innerHTML = pointsLeft;
							dfCount = parseInt(dfCount, 10) + parseInt(1, 10);
							playerCount = parseInt(playerCount, 10) + parseInt(1, 10);
							//var idName = "player"+playerCount;
							//var playerName = $(this).attr("name");
							//document.getElementById(idName).setAttribute("value", playerName);
						}
					}
					else
					{	
						//var idName = "player"+playerCount;
						//document.getElementById(idName).removeAttribute("value");
						
						$(this).css('box-shadow','0 0 0 0 #dfdfdf');
						pointsReimburse = $(this).attr("title");
						pointsLeft = parseInt(pointsLeft, 10) + parseInt(pointsReimburse, 10);
						document.getElementById("points").innerHTML = pointsLeft;
						dfCount = parseInt(dfCount, 10) - parseInt(1, 10);
						playerCount = parseInt(playerCount, 10) - parseInt(1, 10);
					}
				});
				$('.fw').click(function() {
				
					if(parseInt(fwCount,10)>4 || parseInt(fwCount,10)<0)
					{
						alert("Error in page! Sorry for the inconvenience. Reloading...");
						location.reload();
					}
					if($(this).is(':checked'))
					{
						var playerCost = $(this).attr("title");
						if(parseInt(pointsLeft, 10) < parseInt(playerCost,10))
						{
							alert("NOT ENOUGH POINTS!");
							$(this).prop("checked", false);
							$(this).css('box-shadow','0 0 0 0 #dfdfdf');
						}
						else if(parseInt(fwCount,10) >= 4)
						{
							alert("MAXIMUM FORWARDS SELECTED!");
							$(this).prop("checked", false);
							$(this).css('box-shadow','0 0 0 0 #dfdfdf');
						}
						else
						{
							$(this).css('box-shadow','0 0 10px 1px #dfdfdf');
							//pointsSpend = $(this).attr("value");
							pointsLeft = parseInt(pointsLeft, 10) - parseInt(playerCost, 10);
							document.getElementById("points").innerHTML = pointsLeft;
							fwCount = parseInt(fwCount, 10) + parseInt(1, 10);
							playerCount = parseInt(playerCount, 10) + parseInt(1, 10);
							//var idName = "player"+playerCount;
							//var playerName = $(this).attr("name");
							//document.getElementById(idName).setAttribute("value", playerName);
						}
					}
					else
					{	
						//var idName = "player"+playerCount;
						//document.getElementById(idName).removeAttribute("value");
						
						$(this).css('box-shadow','0 0 0 0 #dfdfdf');
						pointsReimburse = $(this).attr("title");
						pointsLeft = parseInt(pointsLeft, 10) + parseInt(pointsReimburse, 10);
						document.getElementById("points").innerHTML = pointsLeft;
						fwCount = parseInt(fwCount, 10) - parseInt(1, 10);
						playerCount = parseInt(playerCount, 10) - parseInt(1, 10);
					}
				});
			$('#button').click(function(){ if(playerCount == 7) document.forms[0].submit();
									else alert("TEAM NOT COMPLETE!");
									});
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
		#listGK{float:left;font:16px Amethysta;margin-left:30px;}
		#listDF{float:left;font:16px Amethysta;}
		#listFW{float:left;font:16px Amethysta;margin-right:30px;}
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
		.ListPlayer1{background:rgba(0,250,0,0.2);}
		.ListPlayer2{background:rgba(250,0,0,0.2);}
		.ListPlayer3{background:rgba(0,0,0,0.2);}
		.ListPlayer4{background:rgba(250,250,0,0.2);}
		.ListPlayer5{background:rgba(250,250,250,0.2);}
		.ListPlayer6{background:rgba(0,0,250,0.2);}
	</style>
	
	<body>
		<center><div id="header">
		<center><img src="snuLogo.png"></center>
		
			<a href="home.php" class="headerElement">HOME</a>
			<a href="points.php" class="headerElement">POINTS</a>
			<a href="team.php" class="headerElement">MY TEAM</a>
			<a href="#" class="headerElement">HOW TO PLAY</a>
			<a href="#" class="headerElement">ABOUT US</a>
			<a href="logout.php" class="headerElement" id="logout">LOG OUT</a>
		</div></center>
		<br><br>
		
			<center><span style="font:40px Amethysta;color:#dfdfdf;text-shadow:0 0 8px #dfdfdf;margin-left:10px;">SELECT YOUR TEAM</span></center>
			<br><br>
			<form id="teamSelect" action="cap_edit.php" method="POST">
			<center style="font:small-caps 40px Amethysta;color:#dfdfdf;text-shadow:0 0 8px #dfdfdf;margin-left:10px;">Points Left&nbsp;:&nbsp;<span style="font:40px Amethysta;color:#dfdfdf;text-shadow:0 0 8px #dfdfdf;margin-left:10px;" id="points">100<span></center>
			<br><br>
			<table style="float:left;">
			<tr>
				<th colspan="2" align="center">KEY</th>
			</tr>
			<tr>
				<td style="color:gold">Gold</td><td>Goalkeeper</td>
			</tr>
			<tr>
				<td style="color:lime">Lime</td><td>Defensive</td>
			</tr>
			<tr>
				<td style="color:orange">Orange</td><td>Offensive</td>
			</tr>
			<tr>
				<td style="background:rgba(0,0,0,0.2);">Black</td><td>Shadows - CSE</td>
			</tr>
			<tr>
				<td style="background:rgba(250,250,250,0.2);">Silver</td><td>Silver Hawks - Civil</td>
			</tr>
			<tr>
				<td style="background:rgba(0,0,250,0.2);">Blue</td><td>Flying Dutchmen - SoNS&amp;H</td>
			</tr>
			<tr>
				<td style="background:rgba(0,250,0,0.2);">Green</td><td>Titans - Mech</td>
			</tr>
			<tr>
				<td style="background:rgba(250,250,0,0.2);">Yellow</td><td>Sky Larks - EEE</td>
			</tr>
			<tr>
				<td style="background:rgba(250,0,0,0.2);">Red</td><td>Supersonics - ECE</td>
			</tr>
			
			</table>
			<div style="width:auto;position:relative;">
				<?php
					$fetchListGK = mysql_query("select playerName, value, pTeamId from player where position='gk' order by value desc");
					$fetchListDF = mysql_query("select playerName, value, pTeamId from player where position='df' order by value desc");
					$fetchListFW = mysql_query("select playerName, value, pTeamId from player where position='fw' order by value desc");
					echo '<div style="overflow-y:auto;height:300px;">';
					echo '<div id="listGK">';
					while($listGK = mysql_fetch_array($fetchListGK))
					{
						echo '<label><div class="gkListPlayer ListPlayer'.$listGK['pTeamId'].'" style="margin:2px;padding:2px;"><input type="checkbox" value="' . $listGK['playerName'] . '" class="gk" name="player[]" title="'.$listGK['value'].'">' . $listGK['value'] . ' - ' . $listGK['playerName'] . '</div></label>';
					}
					echo '</div>';
					echo '<div id="listDF">';
					while($listDF = mysql_fetch_array($fetchListDF))
					{
						echo '<label><div class="dfListPlayer ListPlayer'.$listDF['pTeamId'].'" style="margin:2px;padding:2px;"><input type="checkbox" value="' . $listDF['playerName'] . '" class="df" name="player[]" title="'.$listDF['value'].'">' . $listDF['value'] . ' - ' . $listDF['playerName'] . '</div></label>';
					}
					echo '</div>';
					echo '<div id="listFW">';
					while($listFW = mysql_fetch_array($fetchListFW))
					{
						echo '<label><div class="fwListPlayer ListPlayer'.$listFW['pTeamId'].'" style="margin:2px;padding:2px;"><input type="checkbox" value="' . $listFW['playerName'] . '" class="fw" name="player[]" title="'.$listFW['value'].'">' . $listFW['value'] . ' - ' . $listFW['playerName'] . '</div></label>';
					}
					echo '</div>';
					echo '</div>';
				?>
				
				<br><br>
			</div>
						
			<center><input id="button" type="button" style="position:relative;left:20%;margin:10px;" value="Proceed"></center>
		</form>
		
		
	</body>
</html>