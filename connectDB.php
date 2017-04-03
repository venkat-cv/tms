<?php

function connectDB(){
	$db = new mysqli('localhost','root','admin','tms');
	if(!$db)
	{
		echo "<br/><br/>Could not connect to database";
		return 0;
	}
	return $db;
}

?>
