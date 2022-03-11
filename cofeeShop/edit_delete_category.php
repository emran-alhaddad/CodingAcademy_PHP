<?php
session_start();
require_once('PresentationLayer/FunctionController.php');
FunctionController::init();
$category;

if(isset($_REQUEST['delete'])) FunctionController::deleteCategory($_REQUEST['delete']);        

else if (isset($_REQUEST['edit'])) $category = FunctionController::getCategory($_REQUEST['edit']);

else
    echo "<script> 
              alert('Access Denied !!!');
              location.href='categories.php'; 
          </script>";
              
  

if(isset($_POST['btn_save']))
  FunctionController::updateCategory(
    id: $_POST['category_id'],
    name: $_POST['category_name'],
    description: $_POST['details']
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
                <h5 class="title">Edit Category</h5>
                <div class="container"> 
                <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" id="category_name" required name="category_name" class="form-control" value='<?php echo $category->name; ?>'>
                        <input type="hidden" name="category_id" value='<?php echo $category->id; ?>'>
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea style="height: auto;" rows="4" cols="80" id="details" required name="details" class="form-control">
                        <?php echo $category->description;?>
                      </textarea>
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

<li class="twitter" ><a href="http://twitter.com"><i class="fab fa-twitter"></i></a></li>
<li class="instagram"><a href="http://instagram.com"> <i class="fab fa-instagram"></i></a></li>
<li class=facebook><a href="http://facebook.com"> <i class="fab fa-facebook"></i></a></li>
</ul>
</div>
</div>


</footer>


</body>
	</html>

