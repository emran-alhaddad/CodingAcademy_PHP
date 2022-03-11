<?php
session_start();
require_once('PresentationLayer/FunctionController.php');
FunctionController::init();
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
                <li><a href="categories.php">CATEGORIES</a></li>
                
      </ul> 
	</nav> 


              <div class="D">
                <div class="oneLineDiv">
                <h1 id="t1">items</h1>
                <a href="add_item.php" class="btn_add" style="color:white;" > Add New Item </a>
                </div>
              
              <hr>
             

             <div class="items">

                  <?php FunctionController::showAllProducts(); ?>
               
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
