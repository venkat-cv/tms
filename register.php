<?php
include('connectDB.php');

if($_REQUEST['username'])
{
	$db = connectDB();
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$name = $_REQUEST['name'];
	$type = $_REQUEST['type'];
	$queryResult = $db->query("select count(*) as count from users where username='".$username."'");
	$rows = $queryResult->fetch_assoc();
	if($rows['count']!=0)
	{
		echo "Username already exists,";
		echo "Try a different username";
	}
	else
	{
		$reportsto = ($_REQUEST['reportsto']=='')?('null'):("'".$_REQUEST['reportsto']."'");
		$myQuery = "INSERT INTO users VALUES(0,'".$name."','".$username."',md5('".$password."'),'".$type."',$reportsto)";
		if(!$db->query($myQuery))
		{
			echo "Could not add user into DB";
		}
		else
		{
			echo "User registered successfully";
		}
	}
}

?>
