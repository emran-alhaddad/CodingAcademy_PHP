<?php

class Validation
{

    public static $userNameError = "";
    public static $passwordError = "";
    public static $rePasswordError = "";
    public static $emailError = "";

    public static function validateUserName($username)
    {
        if (empty($username)) return "Required Field";
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) return "Only letters and white space allowed";
        return "";
    }

    public static function validateEmail($email)
    {
        if (empty($email)) return "Required Field";
        if (!preg_match(
            "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",
            $email
        )) return "Invalid Email";
        return "";
    }

    public static function validatePassword($password, $min = 3, $max = 30)
    {
        if (empty($password)) return "Required Field";
        if (!((strlen($password) >= $min) && (strlen($password) <= $max))) return "Invalid Password Length";
        return "";
    }

    public static function validateRePassword($password, $rePassword)
    {
        if ($password !== $rePassword) return "Passwords not match!";
        return "";
    }

    public static function validateUser($user)
    {
        self::$userNameError = self::validateUserName($user['name']);
        self::$passwordError = self::validatePassword($user['password']);
        self::$rePasswordError = self::validateRePassword($user['password'],$user['retype_password']);
        self::$emailError = self::validateEmail($user['email']);

        if (
            empty(self::$userNameError) && empty(self::$passwordError) &&
            empty(self::$rePasswordError) && empty(self::$emailError)
        )
            return true;
        else return false;
    }
}
