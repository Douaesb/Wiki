<?php
require_once('../controller/usercontroller.php');
$user = new usercontroller();
$user->isLoggedIn('admin');
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

<body>

    <div class="min-h-screen flex flex-col sm:flex-row bg-gray-100">

        <!-- Sidebar -->
        <div class="flex flex-col sm:w-56 bg-white rounded-r-3xl overflow-hidden">
            <div class="flex items-center justify-center h-20 shadow-md">
                <h1 class="text-3xl uppercase text-indigo-500">Logo</h1>
            </div>

            <ul class="flex flex-col py-4">
                <li>
                    <a href="#" class="flex flex-row bg-blue-100 items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>
                </li>


                <li>
                    <a href="categories.php" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-shopping-bag"></i></span>
                        <span class="text-sm font-medium">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="tags.php" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-tag"></i></span>
                        <span class="text-sm font-medium">tags</span>
                    </a>
                </li>
                <li>
                    <a href="../index.php" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-book-open"></i></span>
                        <span class="text-sm font-medium">Wikis</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-user"></i></span>
                        <span class="text-sm font-medium">Profile</span>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-bell"></i></span>
                        <span class="text-sm font-medium">Notifications</span>
                        <span class="ml-auto mr-6 text-sm bg-red-100 rounded-full px-3 py-px text-red-500">5</span>
                    </a>
                </li> -->
                <li>
                    <a href="dashboard.php?deconn" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-log-out"></i></span>
                        <span class="text-sm font-medium">Logout</span>
                    </a>
                </li>
            </ul>

        </div>

        <!-- Content -->
        <div class="flex-grow p-4 bg-gray-200">


                <div class="px-6 py-8 max-w-4xl mx-auto">
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-blue-200 rounded-3xl p-8 mb-5">
                            <h1 class="text-3xl font-bold mb-10">Welcome to your account, We are so happy to see you</h1>

                            <hr class="my-10 border border-blue-700">
                            <div class="flex justify-center items-center">

                                <h2 class="text-2xl font-bold mb-4">Statistiques</h2>
                            </div>
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mt-4">
                                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <dl>
                                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">Total free servers</dt>
                                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600">1.6M</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <dl>
                                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">Servers a month</dt>
                                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600">19.2K</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <dl>
                                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">Servers a week</dt>
                                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600">4.9K</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <dl>
                                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">Total users</dt>
                                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600">166.7K</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <dl>
                                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">Total free servers</dt>
                                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600">1.6M</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <dl>
                                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">Servers a month</dt>
                                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600">19.2K</dd>
                                        </dl>
                                    </div>
                                </div>
                             
                            </div>

                        </div>
                    </div>
                </div>


        </div>




    </div>

</body>

</html>