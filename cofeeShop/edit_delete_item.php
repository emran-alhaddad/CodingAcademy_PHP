<?php
session_start();
require_once('PresentationLayer/FunctionController.php');
FunctionController::init();
$product;

if (isset($_REQUEST['delete'])) FunctionController::deleteProduct($_REQUEST['delete']);

else if (isset($_REQUEST['edit'])) $product = FunctionController::getProduct($_REQUEST['edit']);

else echo "<script> 
              alert('Access Denied !!!');
              location.href='items.php'; 
          </script>";


if (isset($_POST['btn_save'])) 
 FunctionController::updateProduct(
    id: $_POST['product_id'],
    name: $_POST['product_name'],
    image: isset($_POST['change_logo'])?"picture":"",
    price: $_POST['price'],
    description: $_POST['details'],
    category: $_POST['product_type']
  );

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Impresso - items</title>
  <link rel="stylesheet" type="text/css" href="css/impresso3.css">
  <!-- social media icons were taken from the resourse below  -->
  <script src="https://kit.fontawesome.com/cca0a1b6fc.js" crossorigin="anonymous"></script>

  <script>
    function chang_image_field(check_box, field) {
      let img_field = document.getElementById(field);
      if (check_box.checked) {
        img_field.style.visibility = "visible";
      } else
        img_field.style.visibility = "hidden";
    }
  </script>
</head>

<body>
  <nav>

    <div class="logo">
      <p>Impresso</p>
    </div>
    <ul>
      <li><a href="index.php">HOME</a></li>
      <li><a href="items.php">ITEMS</a></li>
      <li><a href="categories.php">CATEGORIES</a></li>
    </ul>
  </nav>

  <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
    <div class="items_2">
      <div class="card card2">
        <h5 class="title">Edit Product</h5>
        <div class="container">
          <div class="form-group">
            <label>Product Name</label>
            <input type="text" id="product_name" required name="product_name" class="form-control" value='<?php echo $product->name; ?>'>
            <input type="hidden" name="product_id" value='<?php echo $product->id; ?>'>
          </div>
          <div class="form-group">
            <label for="">Product Logo</label>
            <label for="change_logo">
              <input id="change_logo" style="width: 20px; height: 15px;" name="change_logo" type="checkbox" onchange="chang_image_field(this,'picture');" value="1">
              Change Product Image?
            </label>
            <input type="file" style="visibility:hidden;" id="picture" name="picture" class="form-control" id="picture" value='<?php echo $product->image; ?>'>
          </div>
          <div class="form-group">
            <label>Pricing</label>
            <input type="text" id="price" name="price" required class="form-control" value='<?php echo $product->price; ?>'>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea style="height: auto;" rows="4" cols="80" id="details" required name="details" class="form-control">
                        <?php echo $product->description; ?>
                      </textarea>
          </div>
          <div class="form-group">
            <label>Product Category</label>

            <select class="form-control" name="product_type">

              <?php
              foreach (FunctionController::$categories as $category)
                if ($category->id == $product->category)
                  echo '<option selected value="' . $category->id . '">' . $category->name . '</option>';
                else
                  echo '<option value="' . $category->id . '">' . $category->name . '</option>';
              ?>
              
            </select>

          </div>

        </div>
        <br>
        <br>
        <br>
        <br>
        <input class="button" style="color:white;" id="btn_save" name="btn_save" type="submit" value="EDIT">
      </div>
    </div>

  </form>

  <div class="footer-content" align="center">
    <h3>alhaddademran@gmail.com <br> Phone number:+967770774255 </h3>
    <br>
    <div class="socials">
      <ul>

        <li class="twitter"><a href="http://twitter.com"><i class="fab fa-twitter"></i></a></li>
        <li class="instagram"><a href="http://instagram.com"> <i class="fab fa-instagram"></i></a></li>
        <li class=facebook><a href="http://facebook.com"> <i class="fab fa-facebook"></i></a></li>
      </ul>
    </div>
  </div>


  </footer>


</body>

</html>