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
			<br>
			<br>		
		</div>
	
    	<div class="input-group">
    	<button type="submit" class="btn" name="continueWorkout">Continue Practise</button>
    
    	</div>
	</form>

	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<p><strong><?php echo $_SESSION['question']; ?></strong></p>
			<p><strong><?php echo $_SESSION['qRequirement']; ?></strong></p>
			<p><strong><?php echo $_SESSION['qDescription']; ?></strong></p>
			
			
		<?php endif ?>
	</div>




	?>
</body>
</html>