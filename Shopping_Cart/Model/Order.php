<?php

class Order
{
    private $userFullName;
    private $userEmail;
    private $userPhone;
    private $userAddress;
    private $userProduct;
    private $amountPaid;
    private $cardId;
    private $orderDate;


    function __construct(
        $userFullName = "",
        $userEmail = "",
        $userPhone = "",
        $userAddress = "",
        $userProduct = "",
        $amountPaid = "",
        $cardId = "",
        $orderDate = ""
    ) {
        $this->userFullName = $userFullName;
        $this->userEmail = $userEmail;
        $this->userPhone = $userPhone;
        $this->userAddress = $userAddress;
        $this->userProduct = $userProduct;
        $this->amountPaid = $amountPaid;
        $this->cardId = $cardId;
        $this->orderDate = $orderDate;
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
