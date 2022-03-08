<?php
session_start();
include("db.php");


if(isset($_POST['btn_save']))
{
$product_name=$_POST['product_name'];
$details=$_POST['details'];
$price=$_POST['price'];
$product_type=$_POST['product_type'];

//picture coding
$picture_name=$_FILES['picture']['name'];
$picture_type=$_FILES['picture']['type'];
$picture_tmp_name=$_FILES['picture']['tmp_name'];
$picture_size=$_FILES['picture']['size'];

if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png" || $picture_type=="image/gif")
{
	if($picture_size<=50000000)
	
		$pic_name=time()."_".$picture_name;
		move_uploaded_file($picture_tmp_name,"product_images/".$pic_name);
mysqli_query($con,"insert into item (name, logo,Price,description, categoryID) values ('$product_name','$pic_name','$price','$details','$product_type')") or die ("query incorrect");
mysqli_close($con);
echo "<script> 
            alert('New Product Added Success ');
            location.href='Admin.php'; </script>";
            exit;
}


}
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
      <img src="images/logo1.jpeg" class="log" alt="logo" width="100" height="70"/>
      <div class="logo">
        <p>Impresso</p>
      </div>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="items.php">Items</a></li>
        <li><a href="about-us.html">About us</a></li>
        <li><a href="#"><img id="fav" src="images/fav.png" alt="Fav" width="40" height="40"/></a></li>
        <li><a href="#"><img id="bag" src="images/bag.png" alt="bag" width="35" height="35"/></a></li>

      </ul>
    </nav>
    
    <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
              <div class="items_2">
               <div class="card card2"> 
                <h5 class="title">Add Product</h5>
                <div class="container"> 
                <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" id="product_name" required name="product_name" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="">Product Logo</label>
                        <input type="file" name="picture" required class="form-control" id="picture" >
                      </div>
                      <div class="form-group">
                        <label>Pricing</label>
                        <input type="text" id="price" name="price" required class="form-control" >
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea style="height: auto;" rows="4" cols="80" id="details" required name="details" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Product Category</label>

                        <select class="form-control" name="product_type">
                        <?php 
                        
                        $sql = " SELECT * FROM `category` WHERE 1";
                        if (!$con) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0)
                        {

                          while($row = mysqli_fetch_assoc($result)) 
                          {
                          echo '<option value="'.$row['cat_ID'].'">'.$row['cat_name'].'</option>';
                          }
                        }
                                        
                        ?>
                        </select>
                      
                      </div>
                      
                      </div>
                      <br>
                      <br>
                      <br>
                      <br>
                      <input class="button" style="color:white;" id="btn_save" name="btn_save" type="submit" value="ADD">
                </div>
                </div>
              
              </form>
              

   </body>
</html>
