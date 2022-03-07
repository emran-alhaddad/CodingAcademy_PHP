<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/Impresso3.css">
	
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
                <li><a href="#">ITEMS</a></li>
      </ul> 
	</nav> 


              <div class="D">
              <h1 id="t1"><em>items</em></h1>
              <hr>
             

             <div class="items">

                  <?php
                    include("db.php");
                    $product_query = "SELECT * FROM product,category WHERE cat_ID=categoryID";
                      $run_query = mysqli_query($con,$product_query);
                      
                      if($run_query){
                        while($row = mysqli_fetch_array($run_query)){
                          $pro_id    = $row['ID'];
                          $pro_title = $row['name'];
                          $pro_price = $row['Price'];
                          $pro_image = $row['logo'];
                          $pro_cat = $row['cat_name'];


                        
                          echo "
                          <div class='card'>
                          <a href='#'>
                                <img src='product_images/$pro_image' alt='Avatar' style='width:100%'>
                                <div class='container'>
                                <h4><b>$pro_title</b> </h4>
                                  <p> <i>$pro_price</i></p>
                                </div>
                              </a>
                              <a class='btn_edit' href='edit_delete_item.php?edit=$pro_id'>Edit</a>
			<a class='btn_delete' href='edit_delete_item.php?delete=$pro_id'>Delete</a>
                          </div>
                          ";
                        }
                      }
                  ?>
               
                    </div>
              </div>

                    <footer>
  <br>
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
