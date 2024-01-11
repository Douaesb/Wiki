<?php
require_once('../controller/usercontroller.php');
require_once('../controller/wikiController.php');
require_once('../controller/tagController.php');
require_once('../controller/categorieController.php');
session_start();
$user = new usercontroller();
$result = $user->checkRoleAdmin();
$result2 = $user->checkRoleAuteur();
$wiki = new wikiController();
$w = $wiki->displayAllWikis();
$wiki->archiveWiki();

$wikiData = $wiki->detailsWikis();

foreach ($wikiData as $wikiItem) {
    $wikis = $wikiItem['wiki'];
    $category = $wikiItem['category'];
    $user = $wikiItem['user'];
    $tags = $wikiItem['tags'];
}
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
                <h1 class="text-3xl uppercase text-indigo-500">Logo</h1>
            </div>

            <ul class="flex flex-col py-4">
                <li>
                    <a href="home.php" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                        <span class="text-sm font-medium">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
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

        <div class="flex justify-center items-center w-full">
            <div class="flex justify-center items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl w-full">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <div class="flex items-center mb-2">
                        <a href="../index.php" class="inline-flex items-center justify-center h-8 w-8 text-lg text-indigo-500"><i class="bx bx-arrow-back"></i></a>
                        <h4 class="ml-2 text-xl text-gray-500">Categorie : <?php echo $category->getCategorie(); ?></h4>
                    </div>
                    <h5 class=" flex justify-center mb-2= text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Title : <?php echo $wikis->getwiki(); ?></h5>
                    <div class="flex bg-white sm:rounded-lg p-1 gap-8 ml-2">
                        <?php foreach ($tags->getTag() as $onetag)
                            echo '
                    <div class="flex justify-center justify-center w-10 p-1">

                    <span class="inline-flex items-center font-medium rounded-lg text-sm px-4 py-2.5 text-center bg-blue-200 hover:bg-blue-400">
                    ' . $onetag . '</span>
                    </div>

                    ';
                        ?>
                    </div>
                    <p class="mb-3 font-normal text-gray-700"><?php echo $wikis->getContent(); ?></p>

                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-2 mt-3">
                            <span class="inline-flex  items-center justify-end h-8 w-8 text-lg text-indigo-500"><i class="bx bx-user"></i></span>
                            <p class="ml-2 text-indigo-500"><?php echo htmlspecialchars($user->getNom() . ' ' . $user->getPrenom());  ?></p>
                        </div>
                        <div class="flex items-center text-green-500 gap-2 mt-3">
                            <span class="ml- leading-none text-gray-600">Crée le :</span>
                            <span class="leading-none"><?php echo date('j M H:i', strtotime($wikis->getCreationDate())); ?>
                            </span>
                        </div>



                    </div>
                </div>
            </div>
        </div>

    </div>



</body>

</html>