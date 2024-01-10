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
    echo 'Wiki ID: ' . $wikiItem['wiki']->getwikiID() . '<br>';
    echo 'Title: ' . $wikiItem['wiki']->getwiki() . '<br>';
    echo 'Content: ' . $wikiItem['wiki']->getContent() . '<br>';
    echo 'Creation Date: ' . $wikiItem['wiki']->getCreationDate() . '<br>';
    echo 'Category: ' . $wikiItem['category']->getCategorie() . '<br>';
    echo 'User: ' . $wikiItem['user']->getNom() . ' ' . $wikiItem['user']->getPrenom() . '<br>';

    echo 'Tags: ';
    foreach ($wikiItem['tags']->getTag() as $tag) {
        echo '-'.$tag . ' ';
    }
    echo '<br>';
    
    echo '<hr>';
    die("");
}
?>