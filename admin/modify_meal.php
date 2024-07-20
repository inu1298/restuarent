<?php
session_start();
require_once('../inc/database.php');
require_once('../inc/functions.php');

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../login_form.php');
    exit();
}

$errors = [];
$message = '';

if (isset($_GET['id'])) {
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        $errors[] = 'Product not found';
    }
} else {
    $errors[] = 'Invalid product ID';
}

if (isset($_POST['update_product'])) {
    $food_name = mysqli_real_escape_string($conn, $_POST['food_name']);
    $food_price = mysqli_real_escape_string($conn, $_POST['food_price']);
    $about_food = mysqli_real_escape_string($conn, $_POST['about_food']);
    $origin_catagory = mysqli_real_escape_string($conn, $_POST['origin_catagory']);
    $meal_type = mysqli_real_escape_string($conn, $_POST['meal_type']);
    $food_image = $_FILES['food_image']['name'];
    $food_image_tmp_name = $_FILES['food_image']['tmp_name'];
    $food_image_folder = 'uploaded_img/' . $food_image;

    if (empty($food_name) || empty($food_price) || empty($about_food) || empty($origin_catagory) || empty($meal_type)) {
        $errors[] = 'Please fill out all fields';
    } else {
        if (!empty($food_image)) {
            move_uploaded_file($food_image_tmp_name, $food_image_folder);
            $update = "UPDATE product SET 
                food_name = '$food_name', 
                food_price = '$food_price', 
                about_food = '$about_food', 
                origin_catagory = '$origin_catagory', 
                meal_type = '$meal_type', 
                food_image = '$food_image' 
                WHERE id = $product_id";
        } else {
            $update = "UPDATE product SET 
                food_name = '$food_name', 
                food_price = '$food_price', 
                about_food = '$about_food', 
                origin_catagory = '$origin_catagory', 
                meal_type = '$meal_type' 
                WHERE id = $product_id";
        }

        if (mysqli_query($conn, $update)) {
            $message = 'Product updated successfully';
            header('location:meals_manage.php');
            exit();
        } else {
            $errors[] = 'Could not update the product';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Product</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<header>
    <div class="appname">The Gallery Café</div>
    <div class="manage-links">
        <ul>
            <li><a href="../admin/user_maneg.php">Manage User</a></li>
            <li><a href="../admin/meals_manage.php">Manage Meals</a></li>
            <li><a href="#">Manage Order</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
    </div>
    <div class="loggedin">Welcome <?php echo $_SESSION['name']; ?>! <a href="../logout.php">Log Out</a></div>
</header>

<main>
    <h2>Modify Product</h2>
    <?php 
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<span class="message">'.$error.'</span>';
        }
    }

    if (!empty($message)) {
        echo '<span class="message">'.$message.'</span>';
    }
    ?>

    <?php if (!empty($product)): ?>
    <div class="container">
        <div class="admin-product-container">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $product_id; ?>" method="post" enctype="multipart/form-data">
                <input type="text" placeholder="Enter food name" name="food_name" class="box" value="<?php echo htmlspecialchars($product['food_name']); ?>" required>
                <input type="text" placeholder="Enter food price" name="food_price" class="box" value="<?php echo htmlspecialchars($product['food_price']); ?>" required>
                <input type="text" placeholder="Enter about food" name="about_food" class="box" value="<?php echo htmlspecialchars($product['about_food']); ?>" required>
                <select name="origin_catagory" class="box" required>
                    <option value="Sri Lankan" <?php if ($product['origin_catagory'] == 'Sri Lankan') echo 'selected'; ?>>Sri Lankan</option>
                    <option value="Chinese" <?php if ($product['origin_catagory'] == 'Chinese') echo 'selected'; ?>>Chinese</option>
                    <option value="Italian" <?php if ($product['origin_catagory'] == 'Italian') echo 'selected'; ?>>Italian</option>
                </select>
                <select name="meal_type" class="box" required>
                    <option value="Breakfast" <?php if ($product['meal_type'] == 'Breakfast') echo 'selected'; ?>>Breakfast</option>
                    <option value="Lunch" <?php if ($product['meal_type'] == 'Lunch') echo 'selected'; ?>>Lunch</option>
                    <option value="Dinner" <?php if ($product['meal_type'] == 'Dinner') echo 'selected'; ?>>Dinner</option>
                </select>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="food_image" class="box">
                <input type="submit" class="btn" name="update_product" value="Update Product">
            </form>
        </div>
    </div>
    <?php endif; ?>
</main>
</body>
</html>
<?php mysqli_close($conn); ?>
