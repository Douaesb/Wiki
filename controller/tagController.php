<?php
require_once(__DIR__ . '/../model/tagModel.php');

class tagController
{

    public function AddTags()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addtag'])) {
            $tag = new tagModel();
            $tag->setTag($_POST['nomTag']);
            $tag->addTag();
            header('Location: tags.php');
            exit;
        }
    }


    public function DisplayTags()
    {
        $cat = new tagModel();
        return $cat->DisplayTag();
    }

    public function EditTags()
    {
        $tag = new tagModel();
        if (isset($_POST['edittag']) && isset($_POST['tagID'])) {
            $idtag = $_POST['tagID'];
            $tag->settag($_POST['nomTag']);
            $tag->editTag($idtag);
            header("Location: tags.php");
            exit();
        }
    }

    public function deletetag()
    {
        if (isset($_GET['deletetag']) && isset($_GET['tagID']) ) {
            $tagID = $_GET['tagID'];
            $tag = new tagModel();
            $tag->deletetag($tagID);
            header('Location: tags.php');
            exit();
        }
    }
}
