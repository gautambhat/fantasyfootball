<?php 

	mysql_connect("localhost","root","");
	mysql_select_db("fantasy");
	
	$authenticate = mysql_query("Select mid, managerName from manager where username='{$_REQUEST['username']}' and password='{$_REQUEST['password']}'");
	if(mysql_num_rows($authenticate) != 1)
	{
		echo "<br><br><h1 align='center'>Failed to authenticate. Please try again <a href='../index'>here</a>.</h1>";
	}
	else if(mysql_num_rows($authenticate) ==1 )
	{
		echo "<br><br><h1 align='center'>Welcome, User {$_POST['username']}!</h1>";
		session_start();
		$_SESSION["Login"] = "YES";
		$_SESSION["username"] = $_POST['username'];
		while($fetchSession = mysql_fetch_array($authenticate))
		{
			$_SESSION["managerName"] = $fetchSession['managerName'];
			$_SESSION["mid"] = $fetchSession['mid'];
		}
		header('Location: home.php');
	}

?>