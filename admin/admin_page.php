<?php 
session_start(); 
require_once('../inc/database.php'); 
require_once('../inc/functions.php'); 

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../login_form.php');
    exit();
}

$user_list = '';

// getting the list of users
$query = "SELECT * FROM users WHERE  last_login ORDER BY name";
$result = mysqli_query($conn, $query);

verify_query($result);

while ($user = mysqli_fetch_assoc($result)) {
    $user_list .= "<tr>";
    $user_list .= "<td>{$user['name']}</td>";
    $user_list .= "<td>{$user['last_login']}</td>";
    $user_list .= "<td>{$user['user_type']}</td>";
    $user_list .= "</tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../css/main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <style>
        h2 {
            color: black;
            margin-left: 350px;
        }

        h3{
            color: black;
            margin-left: 100px;
            
        }
        .masterlist {
	        width: 80%;
	        max-width: 800px;
	        border-collapse: collapse;
	        margin: 50px auto; 
}


       
    </style>
    <header class="flex justify-between py-6 px-2 bg-neutral-200">
        <div class="appname text-xl">The Gallery Café</div>
        <div class="manage-links">
            <ul>
                <li><a href="../admin/user_maneg.php">Manage User </a></li>
                <li><a href="../admin/meals_manage.php">Manage Meals</a></li>
                <li><a href="../admin/manage_orders.php">Manage Order</a></li>
                <li><a href="../admin/manage_table.php">Manage Table</a></li>
                <li><a href="../admin/manage_reservation.php">Manage Reservation</a></li>
            </ul>
        </div>
        <div class="loggedin flex items-center">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php"><i class='bx bx-log-out text-2xl ms-2 hover:text-red-500'></i></a></div>
    </header>
    <main>
        <h3 class="text-2xl">Users List</h3>

        <table class="masterlist">
            <tr>
                <th>Name</th>
                <th>Last Login</th>
                <th>User Type</th>
            </tr>
            <?php echo $user_list; ?>
        </table>
        
    </main>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
