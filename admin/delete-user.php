<?php session_start(); ?>
<?php require_once('../inc/database.php'); ?>
<?php require_once('../inc/functions.php'); ?>
<?php  
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('location:../login_form.php');
	}
	if (isset($_GET['user_id'])) {
		// getting the user information
		$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

		if ( $user_id == $_SESSION['user_id'] ) {
			// should not delete current user
			header('Location: user_maneg.php?err=cannot_delete_current_user');
		} else {
			// deleting the user
			$query = "UPDATE users SET is_deleted = 1 WHERE id = {$user_id} LIMIT 1";

			$result= mysqli_query($conn, $query);

			if ($result) {
				// user deleted
				header('Location: user_maneg.php?msg=user_deleted');
			} else {
				header('Location: user_maneg.php?err=delete_failed');
			}
		}
		
	} else {
		header('Location: user_maneg.php');
	}
?>