<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Categories</title>
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
                <li><a href="items.php">ITEMS</a></li>
                <li><a href="#">CATEGORIES</a></li>
      </ul> 
	</nav> 


              <div class="D">
                <div class="oneLineDiv">
                <h1 id="t1">Categories</h1>
                <a href="add_category.php" class="btn_add" style="color:white;" > Add New Category </a>
                </div>
              
              <hr>
             

             <div class="items">

            
                  <?php
                    include("db.php");
                    $category_query = "SELECT * FROM category ";
                      $run_query = mysqli_query($con,$category_query);
                      
                      if(mysqli_num_rows($run_query)>0){
                        while($row = mysqli_fetch_array($run_query)){
                          $cat_id    = $row['cat_ID'];
                          $cat_name = $row['cat_name'];
                          $cat_description = $row['description'];
                          
                          echo "
                          <div class='card'>
                          <a href='#'>
                          <span class='cat_id'>$cat_id</span>
                          <span class='cat_title'>$cat_name</span>
                              <div class='container'>
                                <p class='cat_desc'>$cat_description</p>
                              </div>
                              </a>
                              <a class='btn_edit' href='edit_delete_category.php?edit=$cat_id'>Edit</a>
                              <a class='btn_delete' href='edit_delete_category.php?delete=$cat_id'>Delete</a>
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
