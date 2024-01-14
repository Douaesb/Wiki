<?php
require_once(__DIR__ . '/../model/wikiModel.php');

class wikiController
{

    public function addWikis()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addwiki'])) {
            $Wiki = new WikiModel();
            $categoryID = (int)$_POST['categorieID'];
            $iduser = $_SESSION['iduser'];
            
            $title = $this->validateInput($_POST['title']);
            $content = $this->validateInput($_POST['content']);

            if (!$title || !$content) {
                echo "Veuillez fournir un titre et un contenu valides pour le wiki.";
                return;
            }

            $Wiki->setWiki($title);
            $Wiki->setContent($content);
            $Wiki->setCreationDate(date('Y-m-d H:i:s'));

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

    public function editWikis()
    {
        if (isset($_POST['editwiki']) && isset($_POST['wikiID'])) {
            $Wiki = new WikiModel();
            $wikiID = $_POST['wikiID'];
            $categoryID = (int)$_POST['updateWikiCategory'];

            $updateWikiTitle = $this->validateInput($_POST['updateWikiTitle']);
            $updateWikiDescription = $this->validateInput($_POST['updateWikiDescription']);

            if (!$updateWikiTitle || !$updateWikiDescription) {
                echo "Veuillez fournir un titre et une description valides pour le wiki.";
                return;
            }

            $Wiki->setWiki($updateWikiTitle);
            $Wiki->setContent($updateWikiDescription);
            $Wiki->setCreationDate(date('Y-m-d H:i:s'));
            $Wiki->editWiki($wikiID, $categoryID);
            $Wiki->deleteWikiTag($wikiID);

            if (!empty($_POST['updateHiddenUpdateInput'])) {
                $tagIDs = json_decode($_POST['updateHiddenUpdateInput'], true);

                // Remove empty values from the array
                $tagIDs = array_filter($tagIDs);

                foreach ($tagIDs as $tagID) {
                    $Wiki->editWikiTag($wikiID, $tagID);
                }
            }
            header('Location: wikis.php');
            exit;
        }
    }

    private function validateInput($input)
    {
        $trimmedInput = trim($input);
        if (strlen($trimmedInput) > 0) {
            return htmlspecialchars($trimmedInput, ENT_QUOTES, 'UTF-8');
        } else {
            return false;
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

    public function redirectDetails()
    {
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
