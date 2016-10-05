<?php 

	session_start();
	if(isset($_SESSION["Login"]))
	{
		if($_SESSION["Login"] == "YES")
		header('Location: home.php');
	}
?>
<!DOCTYPE html>
<html>
		<title>Shiv Nadar University - Sports League</title>
		<script src="jquery-1.10.2.min.js"></script>
		<script src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Codystar' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/fonts.css"/>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.Input').focus(function(){
						$(this).css("background","#eaeaea");
						$(this).css("box-shadow","0 0 8px 1px #dfdfdf");
						$(this).css("border-color","transparent");
				});
				$('.Input').blur(function(){
						$(this).css("background","rgba(255,255,255,0.7)");
						$(this).css("box-shadow","0 0 0 #dfdfdf");
						$(this).css("border-color","green");
				});
				
			});
			function formSubmit(){document.forms[0].submit();}
			
		</script>
</head>

<style>

html{
	background: url("start.jpg");
	color:white;
	min-height:100%;
	padding:0;
	position:relative;
	}
body{
	color:white;
	min-height:100%;
	padding:0;
	margin:0px 5px;
	position:relative;
	}
#body{min-height:100px;
padding:10px 10px 40px 10px;}
#body p{font:30px Helvetica;}
#button{font:25px Helvetica;
	width: auto;
	color:green;
	background-color:rgba(255,255,255,0.7);
	border-radius:10px;
	padding:10px 18px 10px 18px;
	text-decoration:none;
	}
	#button:hover{color: white;}
	input{
	outline : none;
	padding:5px 10px 5px 10px;
	width:15em;
	border-radius:10px;
	border:2px solid green;
	font:20px Helvetica;
	background:rgba(255,255,255,0.7)}
	#register{
		background: rgba(0,0,0,0.6);
		color:rgba(240,240,240,0.6);
		padding:5px 10px 5px 10px;
		position:absolute;
		top:5px;right:5px;
		text-decoration:none;
		font:20px Helvetica;
	}
	a:link,a:visited,a:active{
		text-decoration:none;
		color:rgba(240,240,240,0.6);
	}
	#register:hover{
	text-shadow:0 0 5px #dfdfdf;
	}
</style>


<body>
	<div id="header">
		<center><img src="SNUSLLogo.png"></center>
	</div>
	<div id="body">
		<a id="register" href="#">Registrations Closed</a>
		<br>
		<center id="heading" style="font:6.3em Codystar,Syncopate; text-shadow:0 0 8px #dfdfdf;color:#dfdfdf;">FANTASY FOOTBALL</center>
		<BR><BR>
		<center>
		<form id="loginForm" action="auth.php" method="POST">
		<input class="Input" type="text" placeholder="Username" name="username">
		<input class="Input" type="password" placeholder="Password" name="password"><BR><BR>
		<input type="submit" id="button" value="Enter Site"></center>
		</form>
	</div>

</body>
</html>