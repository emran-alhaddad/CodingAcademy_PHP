<?php

require_once('BusinessLayer/TableController.php');
require_once('classes/Category.php');
require_once('classes/Product.php');



final class FunctionController
{

    static $categories = [];
    static $products = [];

    // Private Functions

    private static function uploadImage($name)
    {
        //picture coding
        $picture_name = $_FILES[$name]['name'];
        $picture_type = $_FILES[$name]['type'];
        $picture_tmp_name = $_FILES[$name]['tmp_name'];
        $picture_size = $_FILES[$name]['size'];

        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
            if ($picture_size <= 50000000)

                $pic_name = time() . "_" . $picture_name;
            move_uploaded_file($picture_tmp_name, "product_images/" . $pic_name);
            return $pic_name;
        }
    }

    private static function checkProducts()
    {
        if (empty(self::$products)) {
            echo "
                <script> 
                    alert('There is no Products !!!');
                    location.href='items.php'; 
                </script>";
        }
    }

    private static function checkCategories()
    {
        if (empty(self::$categories)) {
            echo "
                <script> 
                    alert('There is no Categories !!!');
                    location.href='items.php'; 
                </script>";
        }
    }

    // ----------------------------------------------------

    public static function init()
    {

        $categories = TableController::getTable(table: 'category');
        while ($category = $categories->fetch_assoc()) {
            array_push(
                self::$categories,
                new Category($category['cat_ID'], $category['cat_name'], $category['description'])
            );
        }

        $products = TableController::getTable(table: 'product');
        while ($product = $products->fetch_assoc()) {
            array_push(
                self::$products,
                new Product(
                    id: $product['ID'],
                    name: $product['name'],
                    image: $product['logo'],
                    price: $product['Price'],
                    description: $product['description'],
                    category: $product['categoryID']
                )
            );
        }
    }

    public function __get($name)
    {
        return self::$$name;
    }

    public static function showProduct($id)
    {
        foreach (self::$products as $product) {
            if ($product->id === $id) {
                $product->show();
                break;
            }
        }
    }

    public static function showAllProducts()
    {
        foreach (self::$products as $product) {
            $product->show();
        }
    }

    public static function getProduct($id)
    {
        foreach (self::$products as $product) {
            if($product->id === $id) return $product;
        }
    }

    public static function getCategory($id)
    {
        foreach (self::$categories as $category) {
            if($category->id === $id) return $category;
        }
    }

    public static function showCategory($id)
    {
        foreach (self::$categories as $category) {
            if ($category->id === $id) {
                $category->show();
                break;
            }
        }
    }

    public static function showAllCategories()
    {
        foreach (self::$categories as $category) {
            $category->show();
        }
    }

    public static function addProduct($name, $image, $price, $description, $category)
    {
        $image = self::uploadImage($image);
        $product = new Product(
            id: null,
            name: $name,
            price: $price,
            image: $image,
            description: $description,
            category: $category
        );
        $product->add();
        array_push(self::$products, $product);
    }

    public static function updateProduct($id, $name, $image, $price, $description, $category)
    {
        
        foreach (self::$products as $product) {
            if($product->id === $id)
            {
                if(!empty($image)) $image = self::uploadImage($image);
                else $image = $product->image;
                $product = new Product(
                    id: $id,
                    name: $name,
                    price: $price,
                    image: $image,
                    description: $description,
                    category: $category
                );
                $product->update();
            }
        }
        
        
    }

    public static function addCategory($name, $description)
    {
        $category = new Category(id: null, name: $name, description: $description);
        $category->add();
        array_push(self::$categories, $category);
    }

    public static function updateCategory($id, $name, $description)
    {
        
        foreach (self::$categories as $category) {
            if($category->id === $id)
            {
                $category = new Category(
                    id: $id,
                    name: $name,
                    description: $description,
                );
                $category->update();
            }
        }
        
        
    }

    public static function deleteProduct($id)
    {
        self::checkProducts();
        foreach (self::$products as $product) {
            if ($product->id === $id) {
                $product->delete();
            }
        }
    }

    public static function deleteAllProducts()
    {
        self::checkProducts();
        foreach (self::$products as $product) {
            $product->empty();
        }
    }

    public static function deleteCategory($id)
    {
        self::checkCategories();
        foreach (self::$categories as $category) {
            if ($category->id === $id) {
                $category->delete();
            }
        }
    }

    public static function deleteAllCategories()
    {
        self::checkCategories();
        foreach (self::$categories as $category) {
            $category->empty();
        }
    }
}
