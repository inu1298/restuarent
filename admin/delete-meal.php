<?php session_start(); ?>
<?php require_once('../inc/database.php'); ?>
<?php require_once('../inc/functions.php'); ?>
<?php  
// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../login_form.php');
    exit();
}

// check if the id parameter is set
if (isset($_GET['id'])) {
    // get the product id
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    // delete the product from the database
    $query = "UPDATE product SET deleted = 1 WHERE id = {$id} LIMIT 1";
    $result= mysqli_query($conn, $query);
    
    if ($result) {
        // redirect to meals_manage.php after deletion
        header('Location: meals_manage.php?msg=user_deleted');
    } else {
        // redirect to meals_manage.php with error message
        header('Location: meals_manage.php?deletion=failed');
    }
} else {
    // if id parameter is not set, redirect to meals_manage.php
    header('Location: meals_manage.php');
}

// close the database connection
mysqli_close($conn);
?>
