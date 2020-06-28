<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'nodeConnect');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$uniqid = uniqid();

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user and set question/score if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password, uniqueID) 
					  VALUES('$username', '$email', '$password', '$uniqid')";
			mysqli_query($db, $query);

			// set initial question/score for this new user(in end application, the initial question should be selected based on this experience)
			$query = "Select `id`FROM `users` WHERE `uniqueID` = '$uniqid'";
			$tableData = mysqli_query($db, $query);
			$rows = mysqli_fetch_assoc($tableData);
			//only one row for sure, so using foreach will not effect
			foreach ($rows as $userDBrow) {
				$userDBid = intval($userDBrow['id']);
				//echo "$userDBid";
				//echo"<br>";
			}

			$query = "INSERT INTO progresscard (`id_fk`, `totalScore`, `totalCoins`, `questionID`) VALUES ('$userDBid',0, 0,'1a')";
			$queryExecute = mysqli_query($db, $query);
			//echo("Query: " . $query);
			//echo"<br>";
			if (!$queryExecute) {
				echo("Error description: " . mysqli_error($db));
			}


			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: ..\index.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: ../index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>