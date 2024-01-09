<?php
require_once(__DIR__ . '/../model/userModel.php');

class usercontroller
{

    public function Register()
    {
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $user = new UserModel();
            $role = 'auteur';
            $user->setnom($_POST['nom']);
            $user->setprenom($_POST['prenom']);
            $user->setemail($_POST['email']);
            $user->setpass($_POST['pass']);
            $user->settel($_POST['tel']);
            $user->setrole($role);
            $error = $user->register();

            if (empty($error)) {
                header('Location: ../view/login.php');
                exit();
            }
            

            return $error;
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
