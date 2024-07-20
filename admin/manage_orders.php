<?php 
session_start(); 
require_once('../inc/database.php'); 
require_once('../inc/functions.php'); 

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../login_form.php');
    exit();
}

$order_list = '';

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM orders WHERE (customer_name LIKE '%$search%') AND deleted = 0 ORDER BY order_date";
} else {
    $query = "SELECT * FROM orders WHERE deleted = 0 ORDER BY order_date";
}

$result = mysqli_query($conn, $query);
verify_query($result);

while ($order = mysqli_fetch_assoc($result)) {
    $order_list .= "<tr>";
    $order_list .= "<td>{$order['customer_name']}</td>";
    $order_list .= "<td>{$order['order_date']}</td>";
    $order_list .= "<td>{$order['status']}</td>";
    $order_list .= "<td>{$order['total']}</td>";
    $order_list .= "<td><a href='edit_order.php?id={$order['id']}'>Edit</a></td>";
    $order_list .= "<td><a href='delete_order.php?id={$order['id']}' onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
    $order_list .= "</tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../css/main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="px-4 py-6 flex justify-between bg-neutral-200">
        <div class="appname text-2xl font-semibold">User Management System</div>
        <div class="last flex jussity-between">
            <div class="search me-4">
            <form action="manage_orders.php" method="get">
                <input type="text" name="search" placeholder="Search" required autofocus>
            </form>
        </div>
        <div class="loggedin flex items-center">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php"><i class='bx bx-log-out text-2xl ms-2 hover:text-red-500'></i></a></div>
        </div>
    </header>
    <main>
        <h1 class="flex justify-between items-center py-4">Orders <span class="hover:text-red-500"><a href="add_order.php">+ Add New</a></span></h1>

        <?php
        if (isset($_GET['deletion'])) {
            if ($_GET['deletion'] == 'success') {
                echo '<p class="success">Order deleted successfully.</p>';
            } elseif ($_GET['deletion'] == 'failed') {
                echo '<p class="error">Failed to delete the order. Please try again.</p>';
            }
        }
        ?>
        <table class="masterlist">
            <tr>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php echo $order_list; ?>
        </table>
    </main>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
