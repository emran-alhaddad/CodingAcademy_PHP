<?php
session_start();
include("db.php");

if(isset($_REQUEST['delete']))
{
  $id = $_REQUEST['delete'];
  mysqli_query($con,'DELETE FROM product WHERE ID='.$id.'');
mysqli_close($con);
echo "<script> 
            alert('Product Deleted Successfully ');
            location.href='items.php'; </script>";
            exit;
}

else if(isset($_REQUEST['edit']))
{

  $id = $_REQUEST['edit'];
  include("db.php");
  $product_query = "SELECT * FROM product,category WHERE cat_ID=categoryID AND ID=".$id."";
    $run_query = mysqli_query($con,$product_query);
    if($run_query){
      while($row = mysqli_fetch_array($run_query)){
        $pro_id    = $row['ID'];
        $pro_title = $row['name'];
        $pro_price = $row['Price'];
        $pro_image = $row['logo'];
        $pro_descr = $row['description'];
        $pro_cat = $row['cat_name'];
      }
    }
  }

  else
  {
    echo "<script> 
              alert('Access Denied !!!');
              location.href='Admin.php'; </script>";
              exit;
  }

if(isset($_POST['btn_save']))
{
  $product_id=$_POST['product_id'];
  $product_name=$_POST['product_name'];
  $details=$_POST['details'];
  $price=$_POST['price'];
  $product_type=$_POST['product_type'];

  //picture coding
  if(isset($_POST['change_logo']))
  {
    $picture_name=$_FILES['picture']['name'];
    $picture_type=$_FILES['picture']['type'];
    $picture_tmp_name=$_FILES['picture']['tmp_name'];
    $picture_size=$_FILES['picture']['size'];

    if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png" || $picture_type=="image/gif")
    {
      if($picture_size<=50000000)
      
        $pic_name=time()."_".$picture_name;
        move_uploaded_file($picture_tmp_name,"product_images/".$pic_name);
        mysqli_query($con,"UPDATE `item` SET `name`='$product_name', `logo`='$pic_name', `Price`='$price', `description`='$details', `categoryID`='$product_type' WHERE `ID`=$product_id") or die ("query incorrect");
        mysqli_close($con);
        echo "<script> 
                    alert('Product Updated Successfully ');
                    location.href='Admin.php'; </script>";
                    exit;
    }


  }
  else
  {

    mysqli_query($con,"UPDATE `item` SET `name`='$product_name', `Price`='$price', `description`='$details', `categoryID`='$product_type' WHERE `ID`=$product_id") or die ("query incorrect");
    mysqli_close($con);
    echo "<script> 
                alert('Product Updated Successfully ');
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

    <script>
      function chang_image_field(check_box , field) {
        let img_field = document.getElementById(field);
        if(check_box.checked)
        {
          img_field.style.visibility = "visible";
        }
        else
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
                <li><a href="#">ITEMS</a></li>
      </ul> 
	</nav> 

    <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
              <div class="items_2">
               <div class="card card2"> 
                <h5 class="title">Edit Product</h5>
                <div class="container"> 
                <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" id="product_name" required name="product_name" class="form-control" value='<?php echo $pro_title; ?>'>
                        <input type="hidden" name="product_id" value='<?php echo $_REQUEST["edit"]; ?>'>
                      </div>
                      <div class="form-group">
                        <label for="">Product Logo</label>
                        <label for="change_logo">
                        <input id="change_logo" style="width: 20px; height: 15px;" name="change_logo" type="checkbox" onchange="chang_image_field(this,'picture');" value="1">
                        Change Product Image?
                        </label>
                        <input type="file" style="visibility:hidden;" id="picture" name="picture"  class="form-control" id="picture" value='<?php echo $pro_image; ?>'>
                      </div>
                      <div class="form-group">
                        <label>Pricing</label>
                        <input type="text" id="price" name="price" required class="form-control" value='<?php echo $pro_price; ?>'>
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea style="height: auto;" rows="4" cols="80" id="details" required name="details" class="form-control">
                        <?php echo $pro_descr;?>
                      </textarea>
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
                            if ($row['cat_name']==$pro_cat)
                          echo '<option selected value="'.$row['cat_ID'].'">'.$row['cat_name'].'</option>';
                          else
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

