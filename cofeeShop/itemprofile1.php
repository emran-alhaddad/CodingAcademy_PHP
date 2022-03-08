<?php
session_start();
include("db.php");

if(!isset($_REQUEST['item']))
{

echo "<script> 
            alert('Access Denied !!!');
            location.href='index.php'; </script>";
 exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Impresso - Black coffee</title>
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
        <li><a href="admin.php">Account</a></li>
        <li><a href="#"><img id="fav"src="images/fav.png" alt="Fav" width="40" height="40"/></a></li>
        <li><a href="#"><img id="bag"src="images/bag.png" alt="bag" width="35" height="35"/></a></li>

      </ul>
    </nav>

    <?php

if(isset($_REQUEST['item']))
{

$id = $_REQUEST['item'];
                    include("db.php");
                    $product_query = "SELECT * FROM item,category WHERE cat_ID=categoryID AND ID=".$id."";
                      $run_query = mysqli_query($con,$product_query);
                      if(mysqli_num_rows($run_query) > 0){
                        while($row = mysqli_fetch_array($run_query)){
                          $pro_id    = $row['ID'];
                          $pro_title = $row['name'];
                          $pro_price = $row['Price'];
                          $pro_image = $row['logo'];
                          $pro_descr = $row['description'];
                          $pro_cat = $row['cat_name'];


                          echo "
                          <img  src='product_images/$pro_image' class='imgprofile' alt='image of black coffee' />

                          <div id='profile'>
                          <label style='font-weight: bold;' ><em> $pro_title  &emsp;<em> <mark style=' background-color:#bea396; color:#663300;'> $pro_price</mark></label><br><br>
                            <label>ROAST: &ensp;<span style='color:#663300;'> $pro_cat <input type='range' min='0' max='30' step='1' value='0'> Dark</span> </label><br><br>
                            <label>Qty: <input type='number' min='0' max='30' step='1' value='0'></label><br><br>
                              <div class='btns_div'>
                              <button class='btn_edit'> + Add To Bag</button>  
                              <button class='btn_delete'> + Add To Favorite</button><br><br>
                              </div>
                              <div class='btns_div'>
                              <a href='Reviews.php?item=$id'class='button'> Reviews </a> <br><br> 
                              </div>

                              <p><span style='font-family:cursive;color:#663300;'>Description :<br></span>
                              $pro_descr </p>
                            </div>
                          ";
                        }
                      }
                    }
                  ?>

        



    <footer>

     <div class="footer-content" align="center">
       <p>ImpressoSupport@outlook.com <br> Phone number:9201234600 </p>

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
