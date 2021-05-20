<?php require'database.php' ?>
<?php
session_start();
if(!isset($_SESSION['user_id'])){
	header("Location: index.php");
}
$query = mysqli_query($conn,"SELECT * FROM test");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Online Exam site </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@600&display=swap" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="studentHome.php">Online Exams</a>
		    </div>
		    <ul class="nav navbar-nav">
		      <li class="active"><a href="studentHome.php">Home</a></li>
		      <li><a href="studentProfile.php">Profile</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
		    </ul>
		  </div>
		</nav>
    <div class="container">
			<h1 style="text-align:center; font-family: 'Roboto Mono', monospace;">TESTS</h1>
			<div class="row">
				<div class="col-lg-12">
					<div id="active_test" class="well" style="background-color:#d9f1ff; font-size:22px;">
						<h3 style="text-align:center;">Active Tests</h3>
						<table class="table">
							    <thead>
							      <tr>
							        <th>Test Name</th>
							        <th>Subject</th>
							        <th>Ends on</th>
							        <th>Start Test</th>
							      </tr>
							    </thead>
							    <tbody>
							    	<?php foreach ($results as $result):
										if((strtotime($result['sdatetime']) <= strtotime(date("Y-m-d h:i:sa")))  && (strtotime($result['edatetime']) > strtotime(date("Y-m-d h:i:sa")))  ){ ?>
										      <tr>
										        <td><?php echo $result['test_name'];?></td>
										        <td><?php echo $result['subject']; ?></td>
										        <td><?php echo $result['edatetime']; ?></td>
										        <td><a href="solveTest.php?var=<?php echo $result['test_id'];?>" class="btn btn-primary" style="font-size:20px;background-color:#6d2aff;border-radius:5px;">Start Test</a></td>
										      </tr>
										<?php } ?>
									<?php endforeach; ?>
							    </tbody>
							</table>
					</div>
					<div id="active_test" class="well" style="background-color:#d9f1ff; font-size:22px;">
						<h3 style="text-align:center;">Upcoming Tests</h3>
							<table class="table">
							    <thead>
							      <tr>
							        <th>Test Name</th>
							        <th>Subject</th>
							        <th>Starts on</th>
							      </tr>
							    </thead>
							    <tbody>
							    	<?php foreach ($results as $result):
										if(strtotime($result['sdatetime']) > strtotime(date("Y-m-d h:i:sa"))){ ?>
										      <tr>
										        <td><?php echo $result['test_name'];?></td>
										        <td><?php echo $result['subject']; ?></td>
										        <td><?php echo $result['sdatetime']; ?></td>
										      </tr>
										<?php } ?>
									<?php endforeach; ?>
							    </tbody>
							</table>
					</div>
				</div>
				<div class="col-lg-12">
					<div id="active_test" class="well" style="background-color:#f7ffdc; font-size:22px;" >
						<h3 style="text-align:center;">Past Tests</h3>
						<table class="table">
							    <thead>
							      <tr>
							        <th>Test Name</th>
							        <th>Subject</th>
							        <th>Ended on</th>
							        <th>Check Results</th>
							      </tr>
							    </thead>
							    <tbody>
							    	<?php foreach ($results as $result):
										if((strtotime($result['edatetime']) < strtotime(date("Y-m-d h:i:sa")))){ ?>
										      <tr>
										        <td><?php echo $result['test_name'];?></td>
										        <td><?php echo $result['subject']; ?></td>
										        <td><?php echo $result['edatetime']; ?></td>
										        <td><a href="" class="btn btn-primary" style="font-size:20px; margin-left:20px;background-color:black;">Summary</a></td>
										      </tr>
										<?php } ?>
									<?php endforeach; ?>
							    </tbody>
							</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
