<?php
session_start();
include('user_page.php');

require_once('inc/database.php'); 
require_once('inc/functions.php'); 

$food_list = '';
$search = '';

// getting the list of products
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM product WHERE (food_name LIKE '%$search%') AND deleted = 0 ORDER BY food_name";
} else {
    $query = "SELECT * FROM product WHERE deleted = 0 ORDER BY food_name";
}

$cards = "";

$result = mysqli_query($conn, $query);
verify_query($result);

    while ($row = mysqli_fetch_assoc($result)) {

        $cards .= "<div class=\"card m-1\">";
        $cards .=         "<div class='card-img p-2'><img src=\"images/{$row['food_image']}\" class=\"card-img-top\" alt=\"...\"></div>";
        $cards .= "<ul class=\"list-group list-group-flush\">";
        $cards .=   "<li class=\"list-group-item\">" . ucfirst($row['food_name']) . " Price is: Rs.{$row['food_price']}</li>";
        $cards .= "</ul>";
        $cards .=        "<div class=\"card-body flex flex-col\">";
        $cards .=            "<h5 class=\"card-title\">" . ucfirst($row['food_name']) . " " . "<span class=\"badge text-bg-danger\">" . $row['food_name'] . "</span>" . "</h5>";
        $cards .=            "<p class=\"card-text\">" . ucfirst($row['about_food']) . "</p>";
        $cards .=            "<div class='mt-auto '><a href=\"#\" class=\"btn btn-primary\">Order</a></div>";
        $cards .=        "</div>";
        $cards .=    "</div>";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Meals</title>
    <link rel="stylesheet" href="../css/main.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="menu.css">
 
</head>
<body>
        <div class="container mt-5">
            <div>
            <h1 class="mb-2">Meals</h1>   
            </div>   


            <div class=" flex justify-between">
                <?php
                    if(isset($cards)){
                        echo $cards;
                    }
                ?>
            </div>
        </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
