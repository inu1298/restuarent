<?php session_start(); ?>
<?php require_once('../inc/database.php'); ?>
<?php require_once('../inc/functions.php'); ?>
<?php 

 // checking if a user is logged in
 if (!isset($_SESSION['user_id'])) {
    header('location:../login_form.php');
}

$errors = array();
$name = '';
$email = '';
$password = '';
$user_type = '';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $user_type =  $_POST['user_type'];

    // checking required fields
    $req_fields = array('name', 'email', 'password', 'user_type');
    $errors = array_merge($errors, check_req_fields($req_fields));

    // checking max length
		$max_len_fields = array('name' => 100, 'email' => 100, 'password' => 50, 'user_type' =>50);
        $errors = array_merge($errors, check_max_len($max_len_fields));

    // check email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email address is invalid.';
		}
	

    // checking if email address already exists
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $query = "SELECT * FROM users WHERE email = '{$email}' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $errors[] = 'Email address already exists';
        }
    }

    // If no errors, insert the new user into the database
    if (empty($errors)) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
        $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

        $query = "INSERT INTO users (name, email, password, user_type, is_deleted) VALUES ('{$name}', '{$email}', '{$password}', '{$user_type}', 0)";

        $result = mysqli_query($conn, $query);

        verify_query($result);

        if ($result) {
            // Redirect to user management page after successful registration
            header('Location: user_maneg.php?user_added=true');
        } else {
            $errors[] = 'Failed to add the new user';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <header>
        <div class="appname">User Management System</div>
        <div class="loggedin">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php">Log Out</a></div>
    </header>

    <main>
        <h1>Add New User<span><a href="user_maneg.php"> < Back to User List</a></span></h1>
        <?php 
            if (!empty($errors)) {
				display_errors($errors);
			}

        ?>

        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <input type="text" placeholder="Enter Name" name="name" class="box"<?php echo 'value="' . $name . '"'; ?>>
                <input type="email" placeholder="Enter Email Address" name="email" class="box" <?php echo 'value="' . $email . '"'; ?>>
                <input type="password" placeholder="Enter Password" name="password" class="box">
                <select name="user_type" class="box" <?php echo 'value="' . $user_type . '"'; ?>>
                <option value="user_type">Select User Type</option>
                    <option value="admin">Admin</option>
                    <option value="operational staff">Operational Staff</option>
                    <option value="user">User</option>
                </select>
                <input type="submit" class="btn" name="submit" value="Save">
            </form>
        </div>
    </main>
</body>
</html>
