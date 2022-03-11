<?php
require_once('BusinessLayer/TableController.php');
include_once('Controller.php');

class Category implements Controller
{

    // Attributes of Category 
    private $id; 
    private $name;
    private $description;

    // default and parametrized constructor
    function __construct($id=0,$name="",$description="")
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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
                    <span class='cat_id'>$this->id</span>
                    <span class='cat_title'>$this->name</span>
                        <div class='container'>
                        <p class='cat_desc'>$this->description</p>
                        </div>
                        </a>
                        <a class='btn_edit' href='edit_delete_category.php?edit=$this->id'>Edit</a>
                        <a class='btn_delete' href='edit_delete_category.php?delete=$this->id'>Delete</a>
                    </div>
        ";
    }

    function add()
    {
        $isInserted = TableController::insertInto('category',["cat_name"=>"'$this->name'", "description"=>"'$this->description'"]);
        if($isInserted)
        {
            echo "
                <script> 
                    alert('New Category Added Success ');
                    location.href='categories.php'; 
                </script>";
        }
    }

    function update()
    {
        $isUpdated = TableController::updateFrom('category',["cat_name"=>"'$this->name'", "description"=>"'$this->description'"]
        ,"cat_ID=$this->id");

        if($isUpdated)
        {
            echo "
                <script> 
                    alert('Category Updated Success ');
                    location.href='categories.php'; 
                </script>";
        }
    }

    function delete()
    {
        $isDeleted = TableController::deleteFrom('category',"cat_ID=$this->id");
        if($isDeleted)
        {
            echo "
                <script> 
                    alert('Category Deleted Success ');
                    location.href='categories.php'; 
                </script>";
        }
    }

    function empty()
    {
        $isDeleted = TableController::deleteFrom('category');
        if($isDeleted)
        {
            echo "
                <script> 
                    alert('All Categories Deleted Success ');
                    location.href='categories.php'; 
                </script>";
        }
    }
}
