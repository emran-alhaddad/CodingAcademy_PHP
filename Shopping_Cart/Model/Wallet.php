<?php

class Wallet{

    private $id;
    private $userId;
    private $cardId;
    private $mony;

    function __construct($id=0,$userId=0,$cardId="",$mony="")
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->cardId = $cardId;
        $this->mony = $mony;
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