<?php 
include('..\registerUser\server.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="../styleSheets/style.css">

</head>
<body>
	<form method="post" action="userDashboard.php">


		<div class="header">

    	    <!-- logged in user information -->		
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>		
			<p> <a href="..\index.php" logout='1' style="color: red;">logout</a> </p>		
		
	
    	<!-- <div class="input-group"> -->
    	<button type="submit" class="btn" name="continueWorkout"  >Continue Practise</button>
    
    	</div>
	</form>	
		<!-- display question here -->
	
		<?php if ($_SESSION['loadQ'] ==1) : ?>
		<div class="questions">	
			<p><strong><?php echo $_SESSION['question']; ?></strong></p>
			<p><strong><?php echo $_SESSION['qRequirement']; ?></strong></p>
			<p><strong><?php echo $_SESSION['qDescription']; ?></strong></p>
		  	<p><strong><?php echo $_SESSION['qID']; ?></strong></p>
		  	<br>
		  	<br>
		  	<a href="templateDownload.php">Download Template</a>
		  	<br>
		  	<br>
		  	<br>
		</div>		
		

	<form action="uploadFile.php" method="post" enctype="multipart/form-data">
		<div class="questions">
			<input type="file" class="btn" name="fileToUpload" id="fileToUpload">
			<button type="submit" class="btn" name="submittSolution">Submitt Solution</button>
		</div>
	</form>

		<?php endif ?>

</body>

</html>