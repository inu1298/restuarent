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

if (isset($_POST['add_product'])) {
    $food_name = $_POST['food_name'];
    $food_price = $_POST['food_price'];
    $about_food = $_POST['about_food'];
    $origin_catagory = $_POST['origin_catagory'];
    $meal_type = $_POST['meal_type'];
    $food_image = $_FILES['food_image']['name'];
    $food_image_tmp_name = $_FILES['food_image']['tmp_name'];
    $food_image_folder = 'uploaded_img/' . $food_image;

    if (!is_dir('uploaded_img')) {
        mkdir('uploaded_img', 0755, true);
    }

    if (empty($food_name) || empty($food_price) || empty($about_food) || empty($origin_catagory) || empty($meal_type) || empty($food_image)) {
        $errors[] = 'Please fill out all fields';
    } else {
        $insert = "INSERT INTO product (food_name, food_price, about_food, origin_catagory, meal_type, food_image) VALUES ('$food_name', '$food_price', '$about_food', '$origin_catagory', '$meal_type', '$food_image')";
        $upload = mysqli_query($conn, $insert);

        if ($upload) {
            if (move_uploaded_file($food_image_tmp_name, $food_image_folder)) {
                $message = 'New product added successfully';
                header('Location: meals_manage.php?product_added=true');
            } else {
                $errors[] = 'Failed to upload image';
            }
        } else {
            $errors[] = 'Could not add the product';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
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
    <h2>Add New Product<span><a href="meals_manage.php"> Back </a></span></h2>
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

    <div class="container">
        <div class="admin-product-container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <input type="text" placeholder="Enter food name" name="food_name" class="box">
                <input type="text" placeholder="Enter food price" name="food_price" class="box">
                <input type="text" placeholder="Enter about food" name="about_food" class="box">
                <select name="origin_catagory" class="box">
                    <option value="Sri Lankan">Sri Lankan</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Italian">Italian</option>
                </select>
                <select name="meal_type" class="box">
                    <option value="Breakfast">Breakfast</option>
                    <option value="Lunch">Lunch</option>
                    <option value="Dinner">Dinner</option>
                </select>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="food_image" class="box">
                <input type="submit" class="btn" name="add_product" value="Add Product">
            </form>
        </div>
    </div>
</main>
</body>
</html>
<?php mysqli_close($conn); ?>
