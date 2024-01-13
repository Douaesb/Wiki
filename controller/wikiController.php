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
    public function EditWikis()
    {
        if (isset($_POST['editwiki']) && isset($_POST['wikiID'])) {
            $Wiki = new WikiModel();
        // die("whyyy");

            $wikiID = $_POST['wikiID'];
            $categoryID = (int)$_POST['updateWikiCategory'];
            $Wiki->setwiki($_POST['updateWikiTitle']);
            $Wiki->setContent($_POST['updateWikiDescription']);
            $Wiki->setCreationDate(date('Y-m-d H:i:s'));
            // var_dump($wikiID, $categoryID, $_POST['updateWikiTitle'], $_POST['updateWikiDescription'], $_POST['selectedUpdateTagIds']);
            // die("whyyy");
            $Wiki->editWiki($wikiID, $categoryID);
            if (!empty($_POST['selectedUpdateTagIds'])) {
                $tagIDs = json_decode($_POST['selectedUpdateTagIds'], true);
                foreach ($tagIDs as $tagID) {
                    $Wiki->editWikiTag($wikiID, $tagID);
                }
            }
            header('Location: wikis.php');
            exit;
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

    public function getMostPostAuthor()
    {
        $wiki = new wikiModel();
        return $wiki->getMostPostAuthor();
    }

    public function getTotalWikis()
    {
        $wiki = new wikiModel();
        return $wiki->getTotalWikis();
    }
    public function getMostUsedCategory()
    {
        $wiki = new wikiModel();
        return $wiki->getMostUsedCategory();
    }
    public function getTotalCategories()
    {
        $wiki = new wikiModel();
        return $wiki->getTotalCategories();
    }
    public function getTotalTags()
    {
        $wiki = new wikiModel();
        return $wiki->getTotalTags();
    }
    public function getTotalAuthors()
    {
        $wiki = new wikiModel();
        return $wiki->getTotalAuthors();
    }


    public function editWiki($wikiID, $title, $content, $categoryID, $tagIDs)
    {
        $wiki = new wikiModel();

        $result = $wiki->editWiki($wikiID, $title, $content, $categoryID, $tagIDs);

        // Handle the result, e.g., redirect or display a message
        if ($result) {
            header("Location: index.php?action=viewWiki&id=" . $wikiID);
        } else {
            echo "Error editing wiki.";
        }
    }

    public function redirectDetails(){
        $source = isset($_GET['source']) ? $_GET['source'] : '';
        if ($source === 'index') {
            return false;
        } elseif ($source === 'wikis') {
            return true;
    }
}
}

$wikisearch = new wikiController();
$wikisearch->searchWikis();
