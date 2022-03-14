<?php

require_once('DataAccessLayer/DBController.php');
require_once('BusinessLayer/TableController.php');
require_once('PresentationLayer/FunctionController.php');
require_once('User.php');
require_once('Templates/alert.php');

if (isset($_POST['addUser'])) {

    $user = new User(
        name: $_POST['name'],
        phone: $_POST['phone'],
        email: $_POST['email'],
        address: $_POST['address']
    );

    if (FunctionController::addUser($user)) {
        alert("User Added Success", "index.php");
    }
    else{
        alert("User Not Added", "index.php");

    }
}

if (isset($_POST['editUser'])) {

    $user = new User(
        id:$_POST['userId'],
        name: $_POST['name'],
        phone: $_POST['phone'],
        email: $_POST['email'],
        address: $_POST['address']
    );


    if (FunctionController::updateUser($user)) {
        alert("User Updated Success", "index.php");
    }
    else{
        alert("User Not Updated", "index.php");

    }
}

if (isset($_GET['deleteUser'])) {

    if ( FunctionController::deleteUser($_GET['deleteUser'])) {
        alert("User Deleted Success", "index.php");
    }
    else{
        alert("User Not Deleted", "index.php");

    }
   ;
}
