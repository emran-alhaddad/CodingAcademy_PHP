<?php

require_once('BusinessLayer/TableController.php');
require_once('Templates/userRow.php');
require_once('User.php');
final class FunctionController
{


    public static function getUser($id)
    {
        return TableController::getTable(table: 'users', condition: "id=$id");
    }

    public static function getUsers()
    {
         foreach(TableController::getTable('users') as $user)
         getUser($user);
    }

    public static function addUser($user)
    {

        return TableController::insertInto(
            'users',
            [
                "name" => "'$user->name'",
                "email" => "'$user->email'",
                "phone" => "'$user->phone'",
                "address" => "'$user->address'"
            ]
        );
        
    }

    public static function updateUser($user)
    {

        return TableController::updateFrom(
            'users',
            [
                "name" => "'$user->name'",
                "email" => "'$user->email'",
                "phone" => "'$user->phone'",
                "address" => "'$user->address'"
            ],
            "id=$user->id"
        );
        
    }

    public static function deleteUser($id)
    {
        return TableController::deleteFrom('users',"id=$id");       
    }
}
