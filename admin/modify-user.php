<?php session_start(); ?>
<?php require_once('../inc/database.php'); ?>
<?php require_once('../inc/functions.php'); ?>
<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('location:../login_form.php');
	}

	$errors = array();
	$user_id = '';
	$name = '';
	$email = '';
	$password = '';
	$user_type = '';


	if (isset($_GET['user_id'])) {
		// getting the user information
		$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
		$query = "SELECT * FROM users WHERE id = {$user_id} LIMIT 1";

		$result = mysqli_query($conn, $query);

		if ($result) {
			if (mysqli_num_rows($result) == 1) {
				// user found
				$result = mysqli_fetch_assoc($result);
				$name = $result['name'];
				$email = $result['email'];
				$user_type = $result['user_type'];

			} else {
				// user not found
				header('Location: user_maneg.php?err=user_not_found');	
			}
		} else {
			// query unsuccessful
			header('Location: user_maneg.php?err=query_failed');
		}
	}

	if (isset($_POST['submit'])) {
		$user_id = $_POST['user_id']; // Add this line to get the user_id from the form
		$name = $_POST['name'];
		$email =  $_POST['email'];
		$password = $_POST['password'];
		$user_type =  $_POST['user_type'];

		// checking required fields
		$req_fields = array('user_id', 'name', 'email', 'user_type');
		$errors = array_merge($errors, check_req_fields($req_fields));

		// checking max length
		$max_len_fields = array('name' => 100, 'email' => 100, 'password' => 50, 'user_type' => 50);
		$errors = array_merge($errors, check_max_len($max_len_fields));

		// checking email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email address is invalid.';
		}

		// checking if email address already exists
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$query = "SELECT * FROM users WHERE email = '{$email}' AND id != '{$user_id}' LIMIT 1"; // Exclude current user
		$result = mysqli_query($conn, $query);

		if ($result) {
			if (mysqli_num_rows($result) == 1) {
				$errors[] = 'Email address already exists';
			}
		}

		if (empty($errors)) {
			// no errors found... updating record
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

			if (!empty($password)) {
				$password = md5($password); 
				$query = "UPDATE users SET name = '{$name}', email = '{$email}', password = '{$password}', user_type = '{$user_type}' WHERE id = {$user_id} LIMIT 1";
			} else {
				$query = "UPDATE users SET name = '{$name}', email = '{$email}', user_type = '{$user_type}' WHERE id = {$user_id} LIMIT 1";
			}

			$result = mysqli_query($conn, $query);

			if ($result) {
				// query successful... redirecting to users page
				header('Location: user_maneg.php?user_modified=true');
			} else {
				$errors[] = 'Failed to modify the record.';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modify User</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="../css/main.css">
	


	
</head>
<body>
	<header>
		<div class="appname">User Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php">Log Out</a></div>
	</header>

	<main>
		<h1>Modify User<span> <a href="user_maneg.php">< Back to User List</a></span></h1>

		<?php 
			if (!empty($errors)) {
				display_errors($errors);
			}
		?>

		<div class="container">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<input type="text" placeholder="Change Name" name="name" class="box" value="<?php echo $name; ?>">
				<input type="email" placeholder="Change Email Address" name="email" class="box" value="<?php echo $email; ?>">
				<input type="password" placeholder="Change Password " name="password" class="box" >
		

				<select name="user_type" class="box">
					<option value="user_type">Select User Type</option>
					<option value="admin" <?php if($user_type == 'admin') echo 'selected'; ?>>Admin</option>
					<option value="operational staff" <?php if($user_type == 'operational staff') echo 'selected'; ?>>Operational Staff</option>
					<option value="user" <?php if($user_type == 'user') echo 'selected'; ?>>User</option>
				</select>
				<input type="submit" class="btn" name="submit" value="Save">
			</form>
		</div>
	</main>
</body>
</html>
