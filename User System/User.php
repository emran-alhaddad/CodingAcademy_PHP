<?php

class User{

    public $id;
    public $name;
    public $email;
    public $phone;
    public $address;

    function __construct($id=0,$name="",$email="",$phone="",$address="")
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
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