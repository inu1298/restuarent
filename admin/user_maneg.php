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
$search = '';

// getting the list of users
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM users WHERE (name LIKE '%$search%' OR email LIKE '%$search%') AND is_deleted = 0 ORDER BY name";
} else {
    $query = "SELECT * FROM users WHERE is_deleted = 0 ORDER BY name";
}

$result = mysqli_query($conn, $query);
verify_query($result);

while ($user = mysqli_fetch_assoc($result)) {
    $user_list .= "<tr>";
    $user_list .= "<td>{$user['name']}</td>";
    $user_list .= "<td>{$user['last_login']}</td>";
    $user_list .= "<td><a href=\"modify-user.php?user_id={$user['id']}\">Edit</a></td>";
    $user_list .= "<td><a href=\"delete-user.php?user_id={$user['id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
    $user_list .= "</tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <header class="flex justify-between">
        <div class="appname">User Management System</div>
        <div class="search">
            <form action="user_maneg.php" method="get">
                <input type="text" name="search" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>" required autofocus>
            </form>
        </div>
        <div class="loggedin">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php">Log Out</a></div>
    </header>
    <main>
        
        <h1>Users <span><a href="add-user.php">+ Add New</a>  |  <a href="user_maneg.php">Back</a></span></h1>
        <table class="masterlist">
            <tr>
                <th>Name</th>
                <th>Last Login</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php echo $user_list; ?>
        </table>
    </main>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
