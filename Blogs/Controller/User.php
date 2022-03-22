<?php
session_start();
require_once("../Models/User.php");
?>

<?php

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../Views/index.php");
    exit;
}


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    unset($_SESSION['username_err']);
    unset($_SESSION['password_err']);

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $_SESSION['username_err'] = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $_SESSION['password_err'] = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($_SESSION['username_err']) && empty($_SESSION['password_err'])) 
    {

        $user = new User(trim($_POST["username"]), md5(trim($_POST["password"])));
        if ($user->login()) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->id;
            $_SESSION["username"] = $user->username;
            unset($_SESSION['password_err']);
            unset($_SESSION['username_err']);
            header("../Views/index.php");
            return;
        } else {
            $_SESSION['password_err'] = "The password you entered was not valid.";
            $_SESSION['username_err'] = "No account found with that username.";
            header("Location: ../Views/login.php");
        }
    } else {
        header("Location: ../Views/login.php");
    }
} else
    header("Location: ../Views/login.php");
?>