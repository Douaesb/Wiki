<?php
require_once(__DIR__ . '/../model/wikiModel.php');

class wikiController
{

    public function AddWikis()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addwiki'])) {
            $Wiki = new WikiModel();
            $iduser = $_SESSION['iduser'];
            $categorieID=1;
            // get the categorie id selected
            $Wiki->setWiki($_POST['title']);
            $Wiki->addWiki($iduser,$categorieID);
            header('Location: wikis.php');
            exit;
        }
    }

}
