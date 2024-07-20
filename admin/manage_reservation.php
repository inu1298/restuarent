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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="px-4 py-6 flex justify-between bg-neutral-200">
        <div class="appname text-2xl font-semibold">User Management System</div>
        <div class="loggedin flex items-center">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php"><i class='bx bx-log-out text-2xl ms-2 hover:text-red-500'></i></a></div>
        </div>
    </header>

    <main>
        <h1>Manage Reservation<span><a href="user_maneg.php" class="hover:text-red-500 ms-4"> < Back to User List</a></span></h1>
        <?php 
            if (!empty($errors)) {
				display_errors($errors);
			}

        ?>
        <div class="container">
            <div class="admin-product-container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="Enter Event Title" name="customer_name" class="box">
                    <input type="text" placeholder="Enter Descritipon" name="status" class="box">
                    <input type="number" placeholder="Enter Number of Guest" name="total" class="box">
                    <input type="date" placeholder="Enter Order Date" name="order_date" class="box">
                    <button type="submit" class="btn">Submit</button>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
