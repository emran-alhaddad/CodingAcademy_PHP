<?php

class Cart{

    private $id;
    private $productName;
    private $productPrice;
    private $productImage;
    private $productQuantity;
    private $totlPrice;
    private $producCode;


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