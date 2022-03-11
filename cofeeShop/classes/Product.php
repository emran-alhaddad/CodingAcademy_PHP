<?php
require_once('BusinessLayer/TableController.php');
include_once('Controller.php');

class Product implements Controller
{

    //  Product attributes
    private $id;
    private $name;
    private $price;
    private $image;
    private $description;
    private $category;

    // default and parametrized constructor
    public function __construct($id = 0, $name = "", $price = 0, $image = "", $description = "", $category = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
        $this->category = $category;
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
        echo "
                <div class='card'>
                    <a href='#'>
                    <img src='product_images/$this->image' alt='Avatar' style='width:100%'>
                    <div class='container'>
                    <h4><b>$this->name</b> </h4>
                        <p> <i>$this->price</i></p>
                    </div>
                    </a>
                    <a class='btn_edit' href='edit_delete_item.php?edit=$this->id'>Edit</a>
                    <a class='btn_delete' href='edit_delete_item.php?delete=$this->id'>Delete</a>
                </div>
        ";
    }

    function add()
    {
        $isInserted = TableController::insertInto('product',["name"=>"'$this->name'", 
        "logo"=>"'$this->image'", "Price"=>"'$this->price'", "description"=>"'$this->description'", 
        "categoryID"=>$this->category]);

        if($isInserted)
        {
            echo "
                <script> 
                    alert('New Product Added Success ');
                    location.href='items.php'; 
                </script>";
        }
    }

    function update()
    {
        $isUpdated = TableController::updateFrom('product',["name"=>"'$this->name'", 
        "logo"=>"'$this->image'", "Price"=>"'$this->price'", "description"=>"'$this->description'", 
        "categoryID"=>$this->category],"ID=$this->id");

        if($isUpdated)
        {
            echo "
                <script> 
                    alert('Product Updated Success ');
                    location.href='items.php'; 
                </script>";
        }
    }

    function delete()
    {
        $isDeleted = TableController::deleteFrom('product',"ID=$this->id");
        if($isDeleted)
        {
            echo "
                <script> 
                    alert('Product Deleted Success ');
                    location.href='items.php'; 
                </script>";
        }
    }

    function empty()
    {
        $isDeleted = TableController::deleteFrom('product');
        if($isDeleted)
        {
            echo "
                <script> 
                    alert('All Products Deleted Success ');
                    location.href='items.php'; 
                </script>";
        }
    }
}
