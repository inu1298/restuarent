<?php
session_start();
include('user_page.php');

?>


<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container mt-[0px]">
        <div class="row mt-4">
            <div class="col-6">
                <h2>Welcome to the Gallery Cafe</h2>
            </div>
        </div>
        <div class="row align-items-center mt-4">
            <div class="col-6 ">
                <img src="image/coffee.png" class="img-fluid mx-auto d-block" width="400px" alt="" srcset="">
            </div>
            <div class="col-6">
                <div class="d-flex flex-column ">
                    <div>
                        <h3>Check Our Meals here! <span class="badge bg-success">New</span></h3>
                        <p>Welcome to our culinary experience! Whether you're a food enthusiast or simply looking for a convenient meal solution, our diverse menu has something for everyone. </p>
                    </div>
                    <div>
                        <button class="btn bg-info" width="100">Click for check Meals</button>
                    </div>
                </div>

            </div>
        </div>


        <div class="row align-items-center mt-4">
            <div class="col-6 ">
                <img src="image/burger.png" class="img-fluid mx-auto d-block" width="400px" alt="" srcset="">
            </div>
            <div class="col-6  order-first">
                <div class="d-flex flex-column ">
                    <div>
                        <h3>Check Special food and beverages <span class="badge bg-success">HOT</span></h3>
                        <p>Discover a world of culinary delights and refreshing drinks with our exclusive specials! Whether you're a foodie looking for the next great dish or someone who enjoys a fine beverage, our menu has something special just for you.</p>
                    </div>
                    <div>
                        <button class="btn bg-info" width="100">Click here</button>
                    </div>
                </div>

            </div>
        </div>


        <div class="row align-items-center mt-4">
            <div class="col-6 ">
                <img src="image/coffee.png" class="img-fluid mx-auto d-block" width="400px" alt="" srcset="">
            </div>
            <div class="col-6">
                <div class="d-flex flex-column ">
                    <div>
                        <h3>Make your Reservastion here! <span class="badge bg-success">New</span></h3>
                        <p>Ensure your dining experience is seamless and unforgettable by reserving your table in advance. Here’s everything you need to know about making a reservation with us :)</p>
                    </div>
                    <div>
                        <button class="btn bg-info" width="100">Click here</button>
                    </div>
                </div>

            </div>
        </div>



    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>