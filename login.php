<!DOCTYPE html>
<html>
<head>
	<!--Login page-->
<?php
session_start();
include('include-scripts.php');
include('connectDB.php');
?>
</head>
<body>

<?php
if($_SESSION['user'])
{
	echo '<script type="text/javascript">location.href = "home.php";</script>';
}
else
{
	if($_REQUEST['submit'])
	{
		$db = connectDB();
		$result = $db->query("SELECT type FROM users where username='".$_REQUEST['username']."' and password=md5('".$_REQUEST['password']."')");
		$row = $result->fetch_assoc();
		$rowcount = $result->num_rows;
		if($rowcount == 1)
		{
			$_SESSION['user'] = $_REQUEST['username'];
			$_SESSION['user-type'] = $row['type'];
			echo '<script type="text/javascript">location.href = "home.php";</script>';
		}
		else
		{
			loginForm('Login Failed!!<br/><br/>');
		}
	}
	else
	{
		loginForm("");
	}
}

function loginForm($par){
	echo '<br/><br/>';
		echo '<div class="container text-center">
				<h2>Welcome to TMS</h2>
				<br/><br/>';
		echo '<label class="control-label col-sm-offset-5 col-sm-2" for="register">New User? </label><br/>
				<div class="col-sm-2 col-sm-offset-5">
				  <input type="button" class="btn btn-primary" id="register" name="register" value="Sign Up!"/>
				</div><br/><br/><br/><br/>';
		echo '<form name="signup" class="form-horizontal col-sm-offset-4 signup-form" method="POST">
				<label for="signup" class="text-center col-sm-6">Signup Form</label><br/><br/>
				<div class="form-group">
					<input type="hidden" name="type" value="Executive">
					<label class="control-label col-sm-2" for="username">Username:</label>
					<div class="col-sm-4">
					  <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="password">Password:</label>
					<div class="col-sm-4"> 
					<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="Name">Name:</label>
					<div class="col-sm-4"> 
					<input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
					</div>
				</div>
				<div class="form-group"> 
					<div class="col-sm-offset-1 col-sm-4">
					  <input type="submit" class="btn btn-primary" name="submit" value="Register"/>
					</div>
				</div>
			</form>';
		echo '<form class="form-horizontal col-sm-offset-4 login-form" name="loginform" method="POST" action="login.php">
				<label for="loginform" class="text-center col-sm-6">Login Form</label><br/><br/>
				  <div class="form-group">
					<label class="control-label col-sm-2" for="username">Username:</label>
					<div class="col-sm-4">
					  <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
					</div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-sm-2" for="password">Password:</label>
					<div class="col-sm-4"> 
					  <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
					</div>
				  </div>
				  <div class="form-group"> 
					<div class="col-sm-offset-1 col-sm-4">
					  <input type="submit" class="btn btn-primary" name="submit" value="Login"/>
					</div>
				  </div>
				</form>';
		echo '<h3 id="login-msg"><br/>'.$par.'</h3></div>';
}
?>
</body>
</html>
