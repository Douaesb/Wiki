<?php
require_once(__DIR__ . '/../model/userModel.php');

class usercontroller
{

    public function Register()
    {
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $user = new UserModel();
            $surname = $_POST['nom'];
            $username = $_POST['prenom'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $tel = $_POST['tel'];
            $role = 'auteur';
            // $role = 'auteur';
           
            // $error = $user->register();

            if (empty($error)) {
                header('Location: ../view/login.php');
                exit();
            }
            if (empty($surname) || strlen($surname) < 3) {
                $error = "Surname should be at least 3 characters.";
            } elseif (empty($username) || strlen($username) < 3) {
                $error = "Username should be at least 3 characters.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email address.";
            } elseif (!preg_match("/^\d{10}$/", $tel)) {
                $error = "Invalid phone number.";
            } elseif (strlen($pass) < 8) {
                $error = "Password should be at least 8 characters.";
            } else {
                $user->setnom($_POST['nom']);
                $user->setprenom($_POST['prenom']);
                $user->setemail($_POST['email']);
                $user->setpass($_POST['pass']);
                $user->settel($_POST['tel']);
                $user->setrole($role);
                $error = $user->Register();
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
