<?php
require_once(__DIR__ . '/../model/tagModel.php');

class tagController
{

    public function addTags()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addtag'])) {
            $tag = new TagModel();
            $nomTag = $this->validateInput($_POST['nomTag']);

            if (!$nomTag) {
                return "Veuillez fournir un nom de tag valide.";
            }

            $tag->setTag($nomTag);
            
            $tagCreated = $tag->addTag();

            if ($tagCreated) {
                header('Location: tags.php');
                exit;
            } else {
                return "Le tag existe déjà !";
            }
        }
    }

    public function displayTags()
    {
        $tag = new TagModel();
        return $tag->displayTag();
    }

    public function editTags()
    {
        $tag = new TagModel();
        if (isset($_POST['edittag']) && isset($_POST['tagID'])) {
            $idtag = $_POST['tagID'];
            $nomTag = $this->validateInput($_POST['nomTag']);

            if (!$nomTag) {
                return "Veuillez fournir un nom de tag valide.";
            }

            $tag->settag($nomTag);
            $tag->editTag($idtag);
            header("Location: tags.php");
            exit();
        }
    }

    public function deleteTag()
    {
        if (isset($_GET['deletetag']) && isset($_GET['tagID'])) {
            $tagID = $_GET['tagID'];
            $tag = new TagModel();
            $tag->deleteTag($tagID);
            header('Location: tags.php');
            exit();
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
}

