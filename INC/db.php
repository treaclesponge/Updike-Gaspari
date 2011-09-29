<?php
// Database connection

mysql_connect("localhost", "markweek_updike", "Ug2011") or die(mysql_error());
//echo "Connected to MySQL<br />";
mysql_select_db("markweek_updikegaspari") or die(mysql_error());
//echo "Connected to Database<br />";
?>