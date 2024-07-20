<?php session_start(); ?>
<?php require_once('inc/database.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php

// check for form submission
if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   // prepare database query
   $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";

   $result = mysqli_query($conn, $select);

   verify_query($result);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      $_SESSION['user_id'] = $row['id'];
      $_SESSION['name'] = $row['name'];

      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         header('location:admin/admin_page.php');

      } elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         header('location:home.php');

      } elseif($row['user_type'] == 'operational staff'){
         $_SESSION['user_name'] = $row['name'];
         header('location:admin/operational_staff.php');
      }

      // updating last login for the currently logged-in user
      $update_query = "UPDATE users SET last_login = NOW() WHERE id = {$_SESSION['user_id']} LIMIT 1";
      $update_result = mysqli_query($conn, $update_query);

      

   } else {
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <?php 
      if (isset($_GET['logout'])) {
         echo '<p class="info">You have successfully logged out from the system</p>';
      }
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>
</div>

</body>
</html>
<?php mysqli_close($conn); ?>
