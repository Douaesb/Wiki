<?php
require_once(__DIR__ . '/../model/userModel.php');

class usercontroller
{

    // public function Register()
    // {
    //     $error = "";

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    //         $user = new UserModel();
    //         $role = 'auteur';
    //         $user->setnom($_POST['nom']);
    //         $user->setprenom($_POST['prenom']);
    //         $user->setemail($_POST['email']);
    //         $user->setpass($_POST['pass']);
    //         $user->settel($_POST['tel']);
    //         $user->setrole($role);
    //         $error = $user->register();

    //         if (empty($error)) {
    //             header('Location: ../view/login.php');
    //             exit();
    //         }
            

    //         return $error;
    //     }
    // }

    public function Register()
{
    $error = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Validate inputs
        $nom = $this->validateInput($_POST['nom']);
        $prenom = $this->validateInput($_POST['prenom']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $pass = $this->validateInput($_POST['pass']);
        $tel = $this->validateInput($_POST['tel']);

        if (!$nom || !$prenom || !$email || !$pass || !$tel) {
            return "Veuillez fournir des données valides.";
        }

        $user = new UserModel();
        $role = 'auteur';
        $user->setnom($nom);
        $user->setprenom($prenom);
        $user->setemail($email);
        $user->setpass($pass);
        $user->settel($tel);
        $user->setrole($role);
        $error = $user->register();

        if (empty($error)) {
            header('Location: ../view/login.php');
            exit();
        }

        return $error;
    }
}

private function validateInput($input)
{
    $trimmedInput = trim($input);
    if (strlen($trimmedInput) > 3) {
        return $trimmedInput;
    } else {
        return false;
    }
}


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pass']) && isset($_POST['email'])) {
            $user = new UserModel();
            $user->setemail($_POST['email']);
            $user->setpass($_POST['pass']);
            $authenticatedUser = $user->login();

            if ($authenticatedUser) {
                session_start();
                $_SESSION['iduser'] = $authenticatedUser['iduser'];
                $_SESSION['nom'] = $authenticatedUser['nom'];
                $_SESSION['role'] = $authenticatedUser['role'];

                if ($_SESSION['role'] === 'admin') {
                    header('Location: ../view/dashboard.php');
                    exit();
                } elseif ($_SESSION['role'] === 'auteur') {
                    header('Location: ../view/home.php');
                    exit();
                }
            } else {
                return "Login failed. Invalid credentials.";
            }
        }
    }

    public function logout()
    {
        if (isset($_GET['deconn'])) {
            $user = new UserModel();
            return $user->logout();
        }
    }

    public function isLoggedIn($requiredRole = null)
    {
        session_start();

        if (!isset($_SESSION['iduser'])) {
            header("Location: login.php");
            exit();
        }

        if ($requiredRole !== null && $_SESSION['role'] !== $requiredRole) {
            header('Location: login.php');
            exit();
        }
    }

    public function checkRoleAdmin()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            return true;
        }
    }
    public function checkRoleAuteur()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'auteur') {
            return true;
        }
    }

}
