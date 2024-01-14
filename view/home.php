<?php
require_once('../controller/usercontroller.php');
$user = new usercontroller();
$user->isLoggedIn('auteur');
$user->login();
$user->logout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link rel="icon" href="../img/wikipedia.png" type="image/png">

    <title>Wiki™</title>
</head>

<!-- component -->
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

<body class="bg-gray-100 md:overflow-hidden">

    <div class="min-h-screen flex flex-col sm:flex-row bg-gray-100">

        <!-- Sidebar -->
        <div class="flex flex-col sm:w-56 bg-white rounded-r-3xl overflow-hidden">
            <div class="flex items-center justify-center h-20 shadow-md">
                <img src="../img/logoWiki.png" class="w-[120px]" alt="">
            </div>

            <ul class="flex flex-col py-4">
                <li>
                    <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                        <span class="text-sm font-medium">Home</span>
                    </a>
                </li>
                <li>
                    <a href="wikis.php" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bxl-wikipedia"></i></span>
                        <span class="text-sm font-medium">My Wikis</span>
                    </a>
                </li>
                <li>
                    <a href="../index.php" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-book-open"></i></span>
                        <span class="text-sm font-medium">All Wikis</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard.php?deconn" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-log-out"></i></span>
                        <span class="text-sm font-medium">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="flex-grow p-4">

        <div id="wrapper" class="grid grid-cols-1 xl:grid-cols-2 xl:h-screen md:overflow-hidden">
        <div id="col-1" class="bg-gray-300 px-12 pt-32 pb-40 md:px-32 xl:py-52 xl:px-32 md:overflow-hidden">
            <h1 class="text-blue-700 font-extrabold text-4xl md:text-6xl"><br>
                Bienvenue<br>
            à votre compte !</h1>
            <p class="text-gray-600 text-normal md:text-3xl pt-3 md:pt-6 font-medium">Consulter toutes les wikis <a href="../index.php" class="text-black underline ">Içi</a></p>
        </div>
        <div id="col-2" class="px-3 md:px-20 xl:py-64 xl:px-12">

            <div id="cards" class="overflow-hidden rounded-lg flex border py-5 px-6 md:py-8 md:px-16 -mt-6 bg-white xl:-ml-24 xl:pl-8 xl:rounded-xl">
                <div id="circle" class="w-8 h-8 bg-blue-500 md:w-16 md:h-16 rounded-full"></div>
                <p class="pl-4 md:pl-12 text-base pt-1 font-semibold md:text-2xl md:pt-4">Créer, Visualiser et gérer vos wikis</p>
            </div>

        </div>
    </div>



        </div>




    </div>
    </div>


</body>

</html>



