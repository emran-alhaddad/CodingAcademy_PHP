<?php
require_once('BusinessLayer/TableController.php');
class User
{

    private $id;
    private $username;
    private $password;
    private $email;
    private $created_at;


    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->created_at = date('d/m/Y H:i:s');
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    // 

    public function login()
    {
        $condition = "username='$this->username' AND password='$this->password'";
        $result = TableController::getTable(__CLASS__, $condition);
        if (count($result) > 0) {
            $this
                ->setId($result[0]->id)
                ->setEmail($result[0]->email);
            return true;
        }

        return false;
    }
}
