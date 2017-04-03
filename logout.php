<?php
session_start();

if($_SESSION['user'])
{
	session_destroy();
	echo "<head>
	<title>Home Page</title>";
	include('include-scripts.php');
	echo "</head>";

	echo '<div class="container text-center" style="position: relative; top: 10%;">';
	echo "<h3>User logged out successfully</h3><br/><br/>";
	echo '<a href="login.php"><input type="button" class="btn btn-primary" value="Login Again"/></a>';
	echo '</div>';
}
else
{
	echo '<script type="text/javascript">location.href = "login.php";</script>';
}
?>
