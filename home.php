<?php
session_start();
include('user_page.php');

?>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>


<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="wraper">
    <section class="img-section flex items-center justify-between px-16">
        <div class="text-white">
            <h4 class="text-lg text-red-500">WELCOME</h4>
            <h2 class="text-5xl font-semibold">
                Best foods </br>
                to your liking
            </h2>
            <p class="text-white mt-6 text-lg w-[70%]">Welcome to gallery cafe, your ultimate culinary destination for discovering mouth-watering meals and delectable beverages. Whether you're a seasoned foodie or just looking for a quick bite, our website offers a diverse range of options to satisfy every craving.</p>
        </div>
    </section>
    <section class="content px-16 mt-3">
        <h2 class="font-semibold mb-4">
            What's new on our site
        </h2>
        <div class="grid grid-rows-2 grid-flow-col gap-4">
            <div class="flex flex-col">
                <img src="image/img1.jpg" alt="" class="image w-[300px] h-[250px] mb-4 ">
                <h2 class="w-[250px]">Seafood soup</h2>
                <p class="w-[250px]">Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula. Ut molestie ultricies porta urna.</p>
            </div>
            <div class="flex flex-col">
                <img src="image/img2.jpg" alt="" class="image w-[300px] h-[250px] mb-4 ">
                <h2 class="w-[250px]">cream and strawberries</h2>
                <p class="w-[250px]">Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula. Ut molestie ultricies porta urna.</p>
            </div>
            <div class="flex flex-col">
                <img src="image/img3.jpg" alt="" class="image w-[300px] h-[250px] mb-4 ">
                <h2 class="w-[250px]">Thailand rice food</h2>
                <p class="w-[250px]">Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula. Ut molestie ultricies porta urna.</p>
            </div>
            <div class="flex flex-col">
                <img src="image/img4.jpg" alt="" class="image w-[300px] h-[250px] mb-4 ">
                <h2 class="w-[250px]">Oriental soup</h2>
                <p class="w-[250px]">Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula. Ut molestie ultricies porta urna.</p>
            </div>
            <div class="flex flex-col">
                <img src="image/img5.jpg" alt="" class="image w-[300px] h-[250px] mb-4 ">
                <h2 class="w-[250px]">Mixed chef’s salad</h2>
                <p class="w-[250px]">Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula. Ut molestie ultricies porta urna.</p>
            </div>
            <div class="flex flex-col">
                <img src="image/img6.jpg" alt="" class="image w-[300px] h-[250px] mb-4 ">
                <h2 class="w-[250px]">Seafood soup</h2>
                <p class="w-[250px]">Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula. Ut molestie ultricies porta urna.</p>
            </div>
            
        </div>
    </section>
</div>
<script src="https://cdn.tailwindcss.com"></script>
</body>

</html>