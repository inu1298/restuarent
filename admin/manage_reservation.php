<?php session_start(); ?>
<?php require_once('../inc/database.php'); ?>
<?php require_once('../inc/functions.php'); ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Table</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <header>
        <div class="appname">User Management System</div>
        <div class="loggedin">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php">Log Out</a></div>
    </header>

    <main>
        <h1>Manage Reservatio<span><a href="user_maneg.php"> < Back to User List</a></span></h1>
        <?php 
            if (!empty($errors)) {
				display_errors($errors);
			}

        ?>
        <div class="container">
            <div class="admin-product-container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="Enter Event Titel" name="customer_name" class="box">
                    <input type="text" placeholder="Enter Descritipon" name="status" class="box">
                    <input type="number" placeholder="Enter Number of Guest" name="total" class="box">
                    <input type="date" placeholder="Enter Order Date" name="order_date" class="box">
                    <input type="submit" class="btn" name="submit" value="Save">
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<?php mysqli_close($conn); ?>
