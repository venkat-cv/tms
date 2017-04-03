<?php
include('connectDB.php');

$db = connectDB();

if($_POST['pk'])
{
	if(($_POST['name'] == 'meetdate')||($_POST['name'] == 'meetdate'))
	{
		$_POST['value'] = $_POST['value'].':00';
	}
	$db->query("UPDATE ".$_POST['title']." set ".$_POST['name']."='".$_POST['value']."' where id='".$_POST['pk']."'");
	
}

print_r($_POST);
?>
