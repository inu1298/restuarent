<?php 
session_start(); 
require_once('../inc/database.php'); 
require_once('../inc/functions.php'); 

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../login_form.php');
    exit();
}

$food_list = '';
$search = '';
// getting the list of products
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM product WHERE (food_name LIKE '%$search%') AND deleted = 0 ORDER BY food_name";
} else {
    $query = "SELECT * FROM product WHERE deleted = 0 ORDER BY food_name";
}

$result = mysqli_query($conn, $query);
verify_query($result);

while ($food = mysqli_fetch_assoc($result)) {
    $food_list .= "<tr>";
    $food_list .= "<td>{$food['food_name']}</td>";
    $food_list .= "<td>{$food['food_price']}</td>";
    $food_list .= "<td>{$food['about_food']}</td>";
    $food_list .= "<td>{$food['origin_catagory']}</td>";
    $food_list .= "<td>{$food['meal_type']}</td>";
    $food_list .= "<td><img src='uploaded_img/{$food['food_image']}' width='100'></td>";
    $food_list .= "<td><a href='modify_meal.php?id={$food['id']}'>Edit</a></td>";
    $food_list .= "<td><a href='delete-meal.php?id={$food['id']}' onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
    $food_list .= "</tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Food</title>
    <link rel="stylesheet" href="../css/main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="px-4 py-6 flex justify-between bg-neutral-200">
        <div class="appname text-2xl font-semibold">User Management System</div>
        <div class="last flex jussity-between">
            <div class="search me-4">
            <form action="meals_manage.php" method="get">
                <input type="text" name="search" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>" required autofocus>
            </form>
        </div>
        <div class="loggedin flex items-center">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php"><i class='bx bx-log-out text-2xl ms-2'></i></a></div>
        </div>
    </header>
    <main>
        <h1 class="flex justify-between items-center py-4">
            Food Products 
            <span>
                <a class="hover:text-red-500" href="add_meal.php"><i class='bx bx-plus'></i> Add Products</a> | <a href="admin_page.php" class="hover:text-red-500">Back</a>
            </span>
        </h1>

        <table class="masterlist">
            <tr>
                <th>Food Name</th>
                <th>Food Price</th>
                <th>About Food</th>
                <th>Origin Category</th>
                <th>Meal Type</th>
                <th>Food Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php echo $food_list; ?>
        </table>
    </main>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
