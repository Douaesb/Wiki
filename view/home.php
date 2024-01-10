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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <title>Wiki™</title>
</head>

<!-- component -->
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

<body class="bg-gray-100">

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
            </ul> <!-- Your existing menu items go here -->
            <!-- ... -->

            <!-- Responsive Navigation Icon -->
            <li class="sm:hidden">
                <button id="menu-toggle" class="flex items-center h-12 text-gray-500 hover:text-gray-800">
                    <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                        <i class="bx bx-menu"></i>
                    </span>
                    <span class="text-sm font-medium">Menu</span>
                </button>
            </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="flex-grow p-4">





        </div>




    </div>
    </div>


</body>

</html>