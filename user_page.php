<?php 

require_once('inc/database.php'); 
require_once('inc/functions.php'); 

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:login_form.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./image/logo.jpg"type="image/x-icone">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>The Gallery Café</title>
    <link rel= "stylesheet" href ="main.css">
</head>

<body>
  <div class="header flex justify-between align-items-center h-[70px] px-4 w-[100%]">
      <div class="appname">The Gallery Café</div>

      <div class="nav">
        <ul>
            <li><a href ="home.php">Home</a></li>
            <li><a href ="menu.php">Menu</a></li>
            <li><a href ="book_table.php">BookTable</a></li>
            <li><a href ="order.html">Order</a></li>
            <li><a href ="about.php">About</a></li>
        </ul>
      </div>


        <div class="loggedin flex align-items-top">Welcome <?php echo $_SESSION['name']; ?>! <a href="logout.php"><i class='bx bx-log-out ms-2' ></i></a></div>

      
  </div>
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->

</body>
</html>