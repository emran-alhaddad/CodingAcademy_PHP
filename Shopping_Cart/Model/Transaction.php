<?php

class Transaction{

    private $id;
    private $cardId;
    private $body;
    private $date;

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