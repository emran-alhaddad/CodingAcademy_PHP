<?php
session_start();
include("db.php");

if(isset($_REQUEST['delete']))
{
  $id = $_REQUEST['delete'];
  mysqli_query($con,'DELETE FROM category WHERE cat_ID='.$id.'');
mysqli_close($con);
echo "<script> 
            alert('Category Deleted Successfully ');
            location.href='categories.php'; </script>";
            
}

else if(isset($_REQUEST['edit']))
{

  $id = $_REQUEST['edit'];
  include_once("db.php");
  $category_query = "SELECT * FROM category WHERE  cat_ID=".$id."";
    $run_query = mysqli_query($con,$category_query);
    if(mysqli_num_rows($run_query)>0){
      while($row = mysqli_fetch_array($run_query)){
        $cat_id    = $row['cat_ID'];
        $cat_title = $row['cat_name'];
        $cat_descr = $row['description'];
      }
    }
  }

  else
  {
    echo "<script> 
              alert('Access Denied !!!');
              location.href='categories.php'; 
          </script>";
              
  }

if(isset($_POST['btn_save']))
{
  $category_id=$_POST['category_id'];
  $category_name=$_POST['category_name'];
  $details=$_POST['details'];


    mysqli_query($con,"UPDATE `category` SET `cat_name`='$category_name', `description`='$details' WHERE `cat_ID`=$category_id") or die ("query incorrect");
    mysqli_close($con);
    echo "<script> 
                alert('Category Updated Successfully ');
                location.href='categories.php'; 
                </script>";
                
  
  
  
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
                        <input type="text" id="category_name" required name="category_name" class="form-control" value='<?php echo $cat_title; ?>'>
                        <input type="hidden" name="category_id" value='<?php echo $_REQUEST["edit"]; ?>'>
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea style="height: auto;" rows="4" cols="80" id="details" required name="details" class="form-control">
                        <?php echo $cat_descr;?>
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

