<?php
session_start();

echo "<head>
<title>Home Page</title>";
include('include-scripts.php');
include('connectDB.php');
echo "</head>";

if($_SESSION['user'])
{
	echo '<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="#">TMS</a>
			</div>';
			echo '<p class="navbar-text">Welcome '.$_SESSION['user'].'</p>';
			echo '<ul class="nav navbar-nav navbar-right">';
			  if($_SESSION['user-type'] == 'Executive')
			  {
				echo '<li class="addSec"><a> Add Secretary</a></li>';
			  }
		echo '<li><a href="logout.php"> Logout</a></li>
			</ul>
		  </div>
		</nav>';
	echo '<div class="container-fluid container-body">';
	secretaryForm();
	echo '<div class="two-pane meet-pane col-sm-6 text-center">
				<input type="button" class="btn btn-primary create-btn" id="createmeet" name="createmeet" value="Create Meeting"/><br/><br/>
				<div class="create-msg create-msg-meet"><h3>Meeting created successfully</h3></div>
				<div class="createmeetForm createForm">
					<form name="meetingform" class="form-horizontal myForm" id="meetform" method="POST">
					  <div class="form-group">
						<label class="control-label col-sm-2" for="meet-title">Title:</label>
						<div class="col-sm-10">
						  <input type="hidden" name="owner" value="'.$_SESSION['user'].'"/>
						  <input type="text" class="form-control" id="meet-title" name="title" placeholder="Meeting Title">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-sm-2" for="meet-date">Date:</label>
						<div class="col-sm-10"> 
						  <input type="datetime-local" required="true" class="form-control" id="meet-date" name="date" placeholder="Meeting Date">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-sm-2" for="meet-desc">Description:</label>
						<div class="col-sm-10"> 
						  <textarea class="form-control" rows="5" id="meet-desc" name="desc" placeholder="Description"></textarea>
						</div>
					  </div>
					  <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" class="btn btn-default submit-btn" name="submit">Submit</button>
						</div>
					  </div>
					</form>
				</div>';
			getMeetingList();	
				
	  echo '</div>';	
			
	  echo '<div class="two-pane meet-pane col-sm-6 text-center">
				<input type="button" class="btn btn-primary create-btn" id="createtask" name="createtask" value="Create Task"/><br/><br/>
				<div class="create-msg create-msg-task"><h3>Task created successfully</h3></div>
				<div class="createtaskForm createForm">
					<form name="taskform" class="form-horizontal myForm" action="">
					  <div class="form-group">
						<label class="control-label col-sm-2" for="task-title">Task Name:</label>
						<div class="col-sm-10">
							<input type="hidden" name="owner" value="'.$_SESSION['user'].'"/>
						  <input type="text" class="form-control" id="task-title" name="title" placeholder="Task Name">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-sm-2" for="task-date">Date:</label>
						<div class="col-sm-10"> 
						  <input type="datetime-local" required="true" class="form-control" id="task-date" name="date">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-sm-2" for="task-desc">Description:</label>
						<div class="col-sm-10"> 
						  <textarea class="form-control" rows="5" id="task-desc" name="desc" placeholder="Description"></textarea>
						</div>
					  </div>
					  <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" class="btn btn-default submit-btn" name="submit">Submit</button>
						</div>
					  </div>
					</form>
				</div>';
			getTaskList();	
		echo '</div>
		</div>';
}
else{
	echo '<h2>Problem Logging In</h2>';
}

function getMeetingList(){
	$db = connectDB();
	echo '<h4>Your Meetings</h4><table class="table meeting-table table-striped table-responsive">
		<tr>
			<th>Title</th><th>Date</th><th>Description</th>
		</tr>';
	$result = $db->query("SELECT * FROM meetings where owner='".$_SESSION['user']."' or owner=(select distinct reportsto from users where username='".$_SESSION['user']."');");
	while($row = $result->fetch_assoc())
	{
		echo '<tr id="'.$row["id"].'">
			<td class="name" data-name="name" data-title="meetings" data-pk="'.$row["id"].'">'.$row["name"].'</td><td class="date" data-name="meetdate" data-title="meetings" data-pk="'.$row["id"].'">'.$row["meetdate"].'</td><td class="desc" data-name="description" data-title="meetings" data-pk="'.$row["id"].'">'.$row["description"].'</td>
		</tr>';
	}	
	echo '</table>';
}

function getTaskList(){
	$db = connectDB();
	echo '<h4>Your Tasks</h4><table class="table task-table table-striped table-responsive">
		<tr>
			<th>Title</th><th>Date</th><th>Description</th>
		</tr>';
	$result = $db->query("SELECT * FROM tasks where owner='".$_SESSION['user']."' or owner=(select distinct reportsto from users where username='".$_SESSION['user']."');");
	while($row = $result->fetch_assoc())
	{
		echo '<tr id="'.$row["id"].'">
			<td class="name" data-title="tasks" data-name="name" data-pk="'.$row["id"].'">'.$row["name"].'</td><td class="date" data-name="taskdate" data-title="tasks" data-pk="'.$row["id"].'">'.$row["taskdate"].'</td><td class="desc" data-name="description" data-title="tasks" data-pk="'.$row["id"].'">'.$row["description"].'</td>
		</tr>';
	}	
	echo '</table>';
}

function secretaryForm(){
	echo '<div class="success-sec text-center"><h4></h4></div>
			<form name="signup" class="form-horizontal col-sm-offset-4 signup-form sec-form" method="POST">
				<h3 id="login-msg"><br/><br/><br/></h3>
				<label for="signup" class="text-center col-sm-6">Secretary Signup Form</label><br/><br/>
				<div class="form-group">
					<label class="control-label col-sm-2" for="username">Username:</label>
					<div class="col-sm-4">
					  <input type="hidden" name="type" value="Secretary">
					  <input type="hidden" name="reportsto" value="'.$_SESSION['user'].'">
					  <input type="text" class="form-control" name="username" id="username" placeholder="Enter Secretary Username">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="password">Password:</label>
					<div class="col-sm-4"> 
					<input type="password" class="form-control" name="password" id="password" placeholder="Enter Secretary Password">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="Name">Name:</label>
					<div class="col-sm-4"> 
					<input type="text" class="form-control" name="name" id="name" placeholder="Enter Secretary Name">
					</div>
				</div>
				<div class="form-group"> 
					<div class="col-sm-offset-1 col-sm-4">
					  <input type="submit" class="btn btn-primary" name="submit" value="Register"/>
					</div>
				</div><br/><br/><br/>
			</form></div>';
}
?>
