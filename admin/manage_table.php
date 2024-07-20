<?php 
session_start(); 
require_once('../inc/database.php'); 
require_once('../inc/functions.php'); 

// Checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../login_form.php');
    exit();
}

$table_list = '';
$search = '';

// Getting the list of tables
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM tables WHERE (name LIKE '%$search%' OR description LIKE '%$search%') AND is_deleted = 0 ORDER BY name";
} else {
    $query = "SELECT * FROM tables WHERE is_deleted = 0 ORDER BY name";
}

$result = mysqli_query($conn, $query);
verify_query($result);

while ($table = mysqli_fetch_assoc($result)) {
    $table_list .= "<tr>";
    $table_list .= "<td>{$table['name']}</td>";
    $table_list .= "<td>{$table['description']}</td>";
    $table_list .= "<td>{$table['capacity']}</td>";
    $table_list .= "<td><a href=\"edit-table.php?table_id={$table['id']}\">Edit</a></td>";
    $table_list .= "<td><a href=\"delete-table.php?table_id={$table['id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
    $table_list .= "</tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tables</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <header>
        <div class="appname">Table Management System</div>
        <div class="search">
            <form action="manage_table.php" method="get">
                <input type="text" name="search" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>" required autofocus>
            </form>
        </div>
        <div class="loggedin">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php">Log Out</a></div>
    </header>
    <main>
        <h1>Tables</h1>
        <table class="masterlist">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Capacity</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php echo $table_list; ?>
        </table>
    </main>
</body>
</html>
<?php mysqli_close($conn); ?>
