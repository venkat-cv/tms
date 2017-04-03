<?php
include('connectDB.php');

if($_REQUEST['cat'])
{
	$db = connectDB();
	$name = $_REQUEST['title'];
	$date = $_REQUEST['date'];
	$desc = $_REQUEST['desc'];
	$owner = $_REQUEST['owner'];
	$formattedDate = ($date == '')?('null'):("'".$date."'");
	if($_REQUEST['cat'] == 'meetingform')
	{
		$insert = "INSERT INTO meetings (`name`,`meetdate`,`description`,`owner`)VALUES('".$name."',".$formattedDate.",'".$desc."','".$owner."')";
		if(!$db->query($insert))
		{
			echo "<br/>Could not insert to meetings<br/>";
		}
	}
	else if($_REQUEST['cat'] == 'taskform')
	{
		$insert = "INSERT INTO tasks (`name`,`taskdate`,`description`,`owner`)VALUES('".$name."',".$formattedDate.",'".$desc."','".$owner."')";
		if(!$db->query($insert))
		{
			echo "<br/>Could not insert to tasks<br/>";
		}
	}
	echo $_REQUEST['cat'];
}
?>
