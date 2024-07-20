<?php 
session_start(); 
require_once('inc/database.php'); 
require_once('inc/functions.php'); 

// Checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:login_form.php');
    exit();
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order_date']);

    // Inserting data into the 'book_tables' table
    $query = "INSERT INTO tables (name, description, capacity, order_date) 
              VALUES ('$name', '$description', '$capacity',  '$order_date')";
    
    $result = mysqli_query($conn, $query);
    verify_query($result);

    if ($result) {
        header('Location: home.php?addition=success');
        exit();
    } else {
        $error = 'Failed to add the book. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Table</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php include('user_page.php'); ?>
    <main>
        <h1>Book Table </h1>
        <?php if (isset($error)) echo '<p class="error">' . $error . '</p>'; ?>

        <div class="container">
            <div class="admin-product-container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="Enter Book Name" name="name" class="box" required>
                    <input type="text" placeholder="Enter Description" name="description" class="box" required>
                    <input type="number" placeholder="Enter Capacity" name="capacity" class="box" required>
                    
                    <input type="date" placeholder="Enter Order Date" name="order_date" class="box" required>
                    <input type="submit" class="btn" name="submit" value="Save">
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<?php mysqli_close($conn); ?>
