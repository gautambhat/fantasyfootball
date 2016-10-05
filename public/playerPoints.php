<?php 

	session_start();
	if(!isset($_SESSION["Login"])) header('Location: index.php');
	
	else if($_SESSION['mid']!=1) header('Location: index.php');
	
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Player Points</title>
	</head>
	<body>
		<br><br><br><br><br><br>
		<form action="playerPointsNext.php" method="POST">
		Enter Team ID : <input type="text" name="teamID"><input type="submit">
		</form>
	</body>
	
</html>

