<?php

class Product{

    private $id;
    private $productName;
    private $productPrice;
    private $productQuantity;
    private $productImage;
    private $productCode;

    function __construct($id=0,$name="",$price=0,$qty=0,$image="",$code="")
    {
        $this->id = $id;
        $this->productName = $name;
        $this->productPrice = $price;
        $this->productQuantity = $qty;
        $this->productImage = $image;
        $this->productCode = $code;
    }
    function __set($name, $value)
    {
        $this->$name = $value;
    }

    function __get($name)
    {
        return $this->$name;
    }

    function show()
    {
        
    }

}

?>