<!DOCTYPE html>

<?php

function createRandomPassword() { 

    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 

    while ($i <= 5) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 

    return $pass; 

} 

if(!(isset($_POST['Name']) && isset($_POST['username'])))
	header("Location: register.html");
else
{

	mysql_connect("localhost","root","");
	mysql_select_db("fantasy");
	
	echo '<html>
	<head>
		<title>Register - SNU Fantasy Football</title>
	</head>
	<style>
		html{background:url("wallpaper.png");}
		body{margin:0 10px; color:#dfdfdf;font-size:18px;}
		a:visited,a:link,a:active{color:white;}
	</style>
	<body>
	<center><img src="snuLogo.png"></center><br><br>';
	
	$check = mysql_query("select managerName from manager where username='".$_POST['username']."'");
	if(mysql_num_rows($check)>0)
	{
		while($found = mysql_fetch_array($check))
		{
			echo "<p style='font-size:18px;'>OOPS! It seems <h2>".$found['managerName']."</h2> has already registered with the NetID <h2>".$_POST['username']."</h2>. <a href='register.html'>Go back</a>.</p>";
		}
	}
	else
	{
		$emailId = $_POST['username']."@snu.edu.in";
		$code = createRandomPassword();
		//echo "<p style='font-size:18px;'>".$code."</p>";
		//mysql_query("insert into manager (username, Name) values ('".$_POST['username']."','".$_POST['password']."','".$_POST['Name']."')") or die(mysql_error());
		//echo "<p style='font-size:18px;'>".$emailId."</p>";
		$message = "Greetings, ".$_POST['Name']."! \r\nYour username: ".$_POST['username'].".\r\nYour Password : ".$code;
		//echo "<p style='font-size:18px;'>".$message."</p>";
		mail($emailId, "Fantasy Football Password", $message, "From: sports.committee@snu.edu.in");
		mysql_query("insert into manager (username,password,managerName,) values('".$_POST['username']."','".$code."','".$_POST['Name']."')");
		
	}
}


?>


		
	</body>
<html>