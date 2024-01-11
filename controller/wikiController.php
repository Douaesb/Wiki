<?php
require_once(__DIR__ . '/../model/wikiModel.php');

class wikiController
{

    public function AddWikis()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addwiki'])) {
            $Wiki = new WikiModel();

            $categoryID = (int)$_POST['categorieID'];
            $iduser = $_SESSION['iduser'];

            $Wiki->setwiki($_POST['title']);
            $Wiki->setContent($_POST['content']);
            $Wiki->setCreationDate(date('Y-m-d H:i:s'));


            // var_dump($iduser, $categoryID, $_POST['title'], $_POST['content'], $_POST['selectedTagIds']);
            // die("whyyy");
            $wikiID = $Wiki->addWiki($iduser, $categoryID);
            if ($wikiID !== false) {
                if (!empty($_POST['selectedTagIds'])) {
                    $tagIDs = json_decode($_POST['selectedTagIds'], true);



                    // var_dump($tagIDs);

                    foreach ($tagIDs as $tagID) {
                        $Wiki->addWikiTag($wikiID, $tagID);
                    }
                }

                header('Location: wikis.php');
                exit;
            } else {
                echo "Failed to add a new wiki.";
            }
        }
    }

    public function DisplayWikis()
    {
        $wiki = new wikiModel();
        if (isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])) {
            $iduser = $_SESSION['iduser'];
            return $wiki->DisplayWikis($iduser);
        }
    }

    public function DisplayAllWikis()
    {
        $wiki = new wikiModel();
        return $wiki->displayAllWikis();
    }

    public function deleteWiki()
    {
        if (isset($_GET['deletewiki']) && isset($_GET['wikiID'])) {
            $wikiID = $_GET['wikiID'];
            // var_dump($wikiID);
            // die("");
            $wiki = new wikiModel();
            $wiki->deleteWiki($wikiID);
            header('Location: wikis.php');
            exit();
        }
    }


    public function archivewiki()
    {
        if (isset($_GET['archivewiki']) && isset($_GET['wikiID'])) {
            $wikiID = $_GET['wikiID'];
            // var_dump($wikiID);
            // die("");
            $wiki = new wikiModel();
            $wiki->archiveWiki($wikiID);
            header('Location: index.php');
            exit();
        }
    }

    public function detailsWikis()
    {
        
        if (isset($_GET['detailswiki']) && isset($_GET['wikiID'])) {
            $wikiID = $_GET['wikiID'];
            // var_dump($wikiID);
            // die("");
            $wiki = new wikiModel();
            return $wiki->detailsWiki($wikiID);
            
        }
    }

    public function searchWikis()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['keyword'])) {
        $keyword = $_POST['keyword'];
    
        $wiki = new wikiModel();
        $searchResults = $wiki->searchWiki($keyword);
    
        header('Content-Type: application/json');
        echo json_encode($searchResults);
    }
}

public function WikisByCategory(){
    $wiki = new wikiModel();
    return $wiki->WikisByCategory();
}
}

$wikisearch = new wikiController();
$wikisearch->searchWikis();


