<?php
require_once(__DIR__ . '/../model/categorieModel.php');

class CategorieController
{

    public function addCategories()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addcat'])) {
            $categorie = new CategorieModel();
            $nomCategorie = $this->validateInput($_POST['nomCategorie']);

            if (!$nomCategorie) {
                return "Veuillez fournir un nom de catégorie valide.";
            }

            $currentDateTime = date('Y-m-d H:i');
            $categorie->setCategorie($nomCategorie);
            $categorie->setDateCategorie($currentDateTime);
            $categorieCreated = $categorie->addcategorie();

            if ($categorieCreated) {
                header('Location: categories.php');
                exit;
            } else {
                return "La catégorie existe déjà !";
            }
        }
    }


    public function displayCategories()
    {
        $categorie = new CategorieModel();
        return $categorie->displayCategorie();
    }

    public function editCategories()
{
    $categorie = new CategorieModel();
    if (isset($_POST['editcat']) && isset($_POST['categorieID'])) {
        $idcat = $_POST['categorieID'];
        $nomCategorie = $this->validateInput($_POST['nomCategorie']);

        if (!$nomCategorie) {
            return "Veuillez fournir un nom de catégorie valide.";
        }
        $currentDateTime = date('Y-m-d H:i');
        $categorie->setCategorie($nomCategorie);
        $categorie->setDateCategorie($currentDateTime);


        $categorieUpdated = $categorie->editCategorie($idcat);

        if ($categorieUpdated) {
            header('Location: categories.php');
            exit;
        } else {
            return "La catégorie existe déjà !";
        }
    }
}

    public function deleteCategorie()
    {
        if (isset($_GET['deletecat']) && isset($_GET['categorieID'])) {
            $categorieID = $_GET['categorieID'];
            $categorie = new CategorieModel();
            $categorie->deleteCategorie($categorieID);
            header('Location: categories.php');
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
