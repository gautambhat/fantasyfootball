<?php

mysql_connect("localhost","root","");
mysql_select_db("fantasy");
$player = $_POST['player'];
foreach($player as $i)
{
	echo '<h2>'.$i.'</h2><br>';
}
?>