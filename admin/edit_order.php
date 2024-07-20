<?php 
session_start(); 
require_once('../inc/database.php'); 
require_once('../inc/functions.php'); 

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../login_form.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM orders WHERE id = {$id} AND deleted = 0 LIMIT 1";
    $result = mysqli_query($conn, $query);
    verify_query($result);

    if (mysqli_num_rows($result) == 1) {
        $order = mysqli_fetch_assoc($result);
    } else {
        header('Location: manage_orders.php?error=notfound');
        exit();
    }
} else {
    header('Location: manage_orders.php');
    exit();
}

if (isset($_POST['submit'])) {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order_date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $total = mysqli_real_escape_string($conn, $_POST['total']);

    $query = "UPDATE orders SET customer_name = '$customer_name', order_date = '$order_date', status = '$status', total = '$total' WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    verify_query($result);

    if ($result) {
        header('Location: manage_orders.php?update=success');
        exit();
    } else {
        $error = 'Failed to update the order. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <header>
        <div class="appname">Order Management System</div>
        <div class="loggedin">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php">Log Out</a></div>
    </header>
    <main>
        <h1>Edit Order <span><a href="manage_orders.php"> < Back to Order List</a></span></h1>
        
        <?php if (isset($error)) echo '<p class="error">' . $error . '</p>'; ?>

        <div class="container">
            <div class="admin-product-container">
                <form action="edit_order.php?id=<?php echo $order['id']; ?>" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="Enter Customer Name" name="customer_name" class="box" value="<?php echo $order['customer_name']; ?>" required>
                    <input type="date" placeholder="Enter Order Date" name="order_date" class="box" value="<?php echo $order['order_date']; ?>" required>
                    <input type="text" placeholder="Enter Status" name="status" class="box" value="<?php echo $order['status']; ?>" required>
                    <input type="number" placeholder="Enter Total" name="total" class="box" value="<?php echo $order['total']; ?>" required>
                    <input type="submit" class="btn" name="submit" value="Save">
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<?php mysqli_close($conn); ?>
