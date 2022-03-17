<?php

class User{

    private $id;
    private $userName;
    private $password;
    private $fullName;
    private $address;
    private $phone;
    private $email;

    function __construct($id=0,$username="",$password="",$fullname="",$adres="",$phone="",$email="")
    {
        $this->id = $id;
        $this->userName = $username;
        $this->password = $password;
        $this->fullName = $fullname;
        $this->address = $adres;
        $this->phone = $phone;
        $this->email = $email;
    }

    function __set($name, $value)
    {
        $this->$name = $value;
    }

    function __get($name)
    {
        return $this->$name;
    }




}

?>