<?php
require_once('controller/usercontroller.php');
require_once('controller/wikiController.php');
require_once('controller/tagController.php');
require_once('controller/categorieController.php');
session_start();
$user = new usercontroller();
$result = $user->checkRoleAdmin();
$result2 = $user->checkRoleAuteur();
$wiki = new wikiController();
$w = $wiki->displayAllWikis();
$wiki->archiveWiki();
$wikiData = $wiki->detailsWikis();
$cat = new categorieController();
$cats = $cat->DisplayCategories();

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
    <link rel="icon" href="img/wikipedia.png" type="image/png">
    <title>Wiki™</title>
</head>

<!-- component -->
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

<body class="bg-gray-100">

    <div class="bg-white shadow-md">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between py-3">
            <!-- Logo -->
            <div class="flex items-center space-x-4 sm:space-x-10">
                <img src="" alt="">

                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" class="search-input border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-500 w-96" placeholder="Search wikis...">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <!-- SVG Search Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#c4c6ca" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg>
                    </div>
                </div>


                <div class="flex  mt-4 items-center space-x-4 md:flex-row">
                    <!-- Login and Sign Up Buttons -->
                    <a href="./view/login.php">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">Login</button>

                    </a>
                    <a href="./view/register.php">
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg">Sign Up</button>

                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap mt-10 mx-auto md:px-12 flex-grow">
            <div class="container mx-auto px-4 md:px-12">
                <div class="flex gap-4">
                    <div class="flex justify-center bg-blue-400 cursor-pointer rounded-xl p-2 w-40 mb-5 shadow-lg wikisButton">

                        <h2 class="text-lg font-bold ">Wikis</h2>

                    </div>
                    <div class="flex justify-center bg-blue-400 cursor-pointer  rounded-xl p-2 w-40 mb-5 shadow-lg categoriesButton">

                        <h2 class="text-lg font-bold">Categories</h2>

                    </div>
                </div>
            </div>
        </div>
        <section class="flex flex-wrap mx-auto md:px-12 flex-grow">
            <div class="container mx-auto px-4 md:px-12">
                <?php
                if ($result) {
                    echo '
            <a href="./view/dashboard.php" class="flex justify-center rounded-xl p-2 w-60 mb-5 shadow-lg bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="bx bx-arrow-back mr-2 flex items-center"></i> Back to Your Account
            </a>
            ';
                } else if ($result2) {
                    echo '
            <a href="./view/wikis.php" class="flex justify-center rounded-xl p-2 w-60 mb-5 shadow-lg bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="bx bx-arrow-back mr-2 flex items-center"></i> Back to Your Account
            </a>
            ';
                }
                ?>


                <div id="wikisContent" class="flex flex-wrap -mx-1 lg:-mx-4">
                    <?php
                    if ($result2 || $result) {
                    } else {
                    ?>
                        <!-- Create Project Card -->
                        <div class="my-1 px-1 w-full md:h-60 md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                            <!-- Article -->
                            <article class="overflow-hidden rounded-lg shadow-lg">
                                <div class="group bg-gray-50   mt- py-16 px-4 flex flex-col space-y-2 items-center cursor-pointer rounded-md ">
                                    <a data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="bg-gray-200 text-yellow-700 group-hover:text-gray-800 group-hover:smooth-hover flex w-20 h-20 rounded-full items-center justify-center" href="./view/register.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </a>
                                    <a class="text-gray-600 group-hover:text-gray-800 group-hover:smooth-hover text-center" href="#">
                                        Create wiki </a>
                                </div>
                            </article>
                            <!-- END Article -->

                        </div>
                        <!-- END Column -->
                    <?php
                    }
                    ?>
                    <?php

                    foreach ($w as $wikiData) : {
                            $wiki = $wikiData['wiki'];
                            $category = $wikiData['category'];
                            $user = $wikiData['user'];
                            $tags = $wikiData['tags'];
                        }
                    ?>

                        <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                            <article class="overflow-hidden rounded-lg shadow-lg h-full
                                    <?php
                                    $bgColors = ['bg-gray-300', 'bg-gray-200', 'bg-gray-100', 'bg-blue-100'];
                                    $randomIndex = array_rand($bgColors);
                                    echo $bgColors[$randomIndex];
                                    ?>
                                            ">
                                <div class="flex flex-col justify-between py-4 px-8 h-52">
                                    <p class="text-gray-700 mb-2">
                                        Categorie :
                                        <?php echo htmlspecialchars($category->getCategorie()); ?>
                                    </p>
                                    <h1 class="text-xl font-semibold mb-2">TITLE :
                                        <?php echo htmlspecialchars($wiki->getwiki()); ?>
                                    </h1>
                                    <div class="flex sm:rounded-lg p-1 gap-8 ml-2">
                                        <?php foreach ($tags->getTag() as $onetag)
                                            echo '
                                            <div class="flex justify-center justify-center w-10 p-1">

                                            <span class="inline-flex items-center font-medium rounded-lg text-sm px-4 py-1.5 text-center bg-blue-200 hover:bg-blue-400">
                                            ' . $onetag . '</span>
                                            </div>

                                            ';
                                        ?>
                                    </div>


                                    <div class="flex justify-between">
                                        <div class="flex flex-col justify-between text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <span class="inline-flex items-center justify-center h-8 w-8 text-lg text-gray-400"><i class="bx bx-user"></i></span>
                                                <p class="ml-2"><?php echo htmlspecialchars($user->getNom() . ' ' . $user->getPrenom());  ?></p>
                                            </div>
                                            <div class="flex items-center text-green-500 gap-2 mt-3">
                                                <span class="ml- leading-none text-gray-600"></span>
                                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-1 leading-none"> <?php echo date('j M H:i', strtotime($wiki->getCreationDate())); ?>
                                                </span>

                                            </div>

                                        </div>
                                        <div class="flex items-center gap-6">
                                            <?php
                                            if ($result) {
                                                echo '
                                          <a title="Archive" href="index.php?archivewiki&wikiID= ' . $wiki->getwikiID() . '">
                                               <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                                              </svg>
                                          </a>
                                            ';
                                            }
                                            ?>
                                            <a href="./view/detailswiki.php?detailswiki&wikiID=<?php echo $wiki->getwikiID(); ?>" title="view details">
                                                <svg xmlns="http://www.w3.org/2000/svg" alt="title" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                                    <path fill="#dfa401" d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="search-results flex flex-wrap mx-auto md:px-12 flex-grow"></div>

            </div>
        </section>


        <section id="categoriesContent" class="flex flex-wrap mt-10 mx-auto md:px-12 flex-grow" style="display: none;">

            <div class="flex-grow rounded-3xl p-2 bg-gray-200 shadow-xl shadow-blue-200">
                <div class="w-full">
                    <div class="bg-blue-200 rounded-3xl p-12 m-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
                            <?php foreach ($cats as $c) : ?>

                                <div class="flex flex-col items-center justify-around bg-white overflow-hidden shadow sm:rounded-lg h-full w-full p-1 mb-2">
                                    <div class="flex justify-center justify-center w-16">
                                        <span class="mt-1 text-xl leading-9 font-semibold text-black whitespace-nowrap"><?php echo $c->getCategorie() ?></span>
                                    </div>
                                    <div class="flex items-center text-green-500 gap-2">
                                        <span class="ml-1 leading-none text-gray-600"> </span>
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1 leading-none"><?php echo date('j M H:i', strtotime($c->getDateCategorie())); ?></span>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>





    </div>




    </div>
    </div>




    <script>
        var wikisContent = document.getElementById('wikisContent').innerHTML;

        function loadContent(category) {
            if (category === 'Wikis') {
                document.getElementById('wikisContent').style.display = 'flex';
                document.getElementById('categoriesContent').style.display = 'none';
                document.querySelector('.categoriesButton').classList.remove('bg-blue-400');
                document.querySelector('.wikisButton').classList.add('bg-blue-400');
            } else if (category === 'Categories') {
                document.getElementById('wikisContent').style.display = 'none';
                document.getElementById('categoriesContent').style.display = 'flex';
                document.querySelector('.wikisButton').classList.remove('bg-blue-400');
                document.querySelector('.categoriesButton').classList.add('bg-blue-400');
            }
        }


        document.querySelector('.categoriesButton').addEventListener('click', function() {
            loadContent('Categories');
        });

        document.querySelector('.wikisButton').addEventListener('click', function() {
            loadContent('Wikis');
        });

        loadContent('Wikis');

        document.querySelectorAll('.editProjectButton').forEach(button => {
            button.addEventListener('click', function() {
                showEditProjectForm(button);
            });
        });


        function showEditProjectForm(button) {
            var editProjectForm = document.getElementById('authentication-modal');
            if (editProjectForm) {
                editProjectForm.querySelector('#editWikiId').value = button.dataset.projectId || '';
                editProjectForm.querySelector('#editName').value = button.dataset.projectName || '';
                editProjectForm.querySelector('#editdescription').value = button.dataset.projectDescription || '';

            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-input');
            const searchResultsContainer = document.querySelector('.search-results');
            const originalCardsContainer = document.getElementById('wikisContent');

            searchInput.addEventListener('input', function() {
                const keyword = searchInput.value.trim();

                if (keyword === '') {
                    // If the search input is empty, display the original cards
                    originalCardsContainer.style.display = 'flex';
                    searchResultsContainer.innerHTML = '';
                } else {
                    // Send an AJAX request to the search_ajax.php file
                    fetch('./controller/wikiController.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'keyword=' + encodeURIComponent(keyword),
                        })
                        .then(response => response.json())
                        .then(data => {
                            originalCardsContainer.style.display = 'none';
                            displaySearchResults(data);
                        })
                        .catch(error => {
                            console.error('Error during AJAX request:', error);
                        });
                }
            });

            function displaySearchResults(results) {
                searchResultsContainer.innerHTML = '';
                if (results.length === 0) {
                    const noResultsMessage = document.createElement('p');
                    noResultsMessage.textContent = 'No results found.';
                    searchResultsContainer.appendChild(noResultsMessage);
                } else {
                    results.forEach(result => {
                        console.log(result);
                        const resultCard = createSearchResultCard(result);
                        searchResultsContainer.appendChild(resultCard);
                    });
                }
                //     results.forEach(result => {
                // console.log(result);

                //         const resultItem = createSearchResultCard(result);
                //         searchResultsContainer.appendChild(resultItem);
                //     });
            }

            function createSearchResultCard(result) {
                const cardContainer = document.createElement('div');
                cardContainer.className = 'my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3';

                const cardArticle = document.createElement('article');
                cardArticle.className = 'overflow-hidden rounded-lg shadow-lg h-full ' + getRandomBackgroundColor();

                const cardContent = document.createElement('div');
                cardContent.className = 'flex flex-col justify-between py-4 px-8 h-52';
                const formattedDate = new Date(result.creationDate).toLocaleString('en-US', {
                    day: 'numeric',
                    month: 'short',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: false,
                });

                cardContent.innerHTML = `
                <p class="text-gray-700 mb-2">Categorie: ${result.nomCategorie}</p>
                <h1 class="text-xl font-semibold mb-2">TITLE: ${result.title}</h1>
                <div class="flex sm:rounded-lg p-1 gap-8 ml-2">
                    ${result.tagnames.split(',').map(tag => `
                        <div class="flex justify-center justify-center w-10 p-1">
                            <span class="inline-flex items-center font-medium rounded-lg text-sm px-4 py-1.5 text-center bg-blue-200 hover:bg-blue-400">
                                ${tag}
                            </span>
                        </div>
                    `).join('')}
                </div>
                <div class="flex justify-between">
                <div class="flex flex-col justify-between text-sm text-gray-600">
                        <div class="flex items-center">
                            <span class="inline-flex items-center justify-center h-8 w-8 text-lg text-gray-400"><i class="bx bx-user"></i></span>
                            <p class="ml-2">${result.nom}${result.prenom}</p>
                        </div>
                        <div class="flex items-center text-green-500 gap-2 mt-3">
                            <span class="ml- leading-none text-gray-600"></span>
                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-1 leading-none">${formattedDate}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        ${result.result ? `
                            <a title="Archive" href="index.php?archivewiki&wikiID=${result.wikiID}">
                                <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                                </svg>
                            </a>
                        ` : ''}
                        <a href="./view/detailswiki.php?detailswiki&wikiID=${result.wikiID}" title="view details">
                            <svg xmlns="http://www.w3.org/2000/svg" alt="title" height="16" width="18" viewBox="0 0 576 512">
                                <path fill="#dfa401" d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                            </svg>                            
                        </a>
                    </div>
                    </div>

            `;

                cardArticle.appendChild(cardContent);

                cardContainer.appendChild(cardArticle);

                return cardContainer;
            }

            function getRandomBackgroundColor() {
                const bgColors = ['bg-gray-300', 'bg-gray-200', 'bg-gray-100', 'bg-blue-100'];
                const randomIndex = Math.floor(Math.random() * bgColors.length);
                return bgColors[randomIndex];
            }
        });
    </script>



</body>

</html>