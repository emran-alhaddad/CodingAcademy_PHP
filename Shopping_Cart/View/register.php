<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shiraz">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register User</title>
    <?php include_once('Components/styles.php'); ?>
</head>

<body>
    <!-- Navbar start -->
    <?php include_once('Components/nav.php'); ?>
    <!-- Navbar end -->

    <div class="container mt-5 mb-5 ">
        <div id="message"></div>
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#register">Register</a></li>
            <li><a data-toggle="tab" href="#login">Login</a></li>
        </ul>
        <div class="tab-content mt-5">
            <div id="register" class="tab-pane fade in active">
                <h2 class="text-center">Register</h2>
                <br>
                <form class="registerform" action="">
                    <div class="form-group">
                        <label for="register_username">User Name</label>
                        <input type="text" name="username" id="register_username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="register_password">Password</label>
                        <input type="password" name="password" id="register_password" class="form-control" required>
                    </div>
                    <br>
                    <h2 class="text-center">Personal Information</h2>
                    <br>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="adress">Adress</label>
                        <input type="text" id="adress" class="form-control" name="adress" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" class="form-control" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" required>
                    </div>
                    <div class="button_holder text-center">
                        <input class="btn btn-primary w-100" id="register_user" type="submit" name="register" value="Register">
                    </div>
                </form>
            </div>

            <div id="login" class="tab-pane fade">
                <h2 class="text-center">Log In</h2>
                <br>
                <form class="loginform" action="" >
                    <div class="form-group">
                        <label for="login_username">User name</label>
                        <input type="text" name="username" class="form-control" id="login_username" required>
                    </div>
                    <div class="form-group mb-5">
                        <label for="login_password">Password</label>
                        <input type="password" name="password" class="form-control" id="login_password" required>
                    </div>
                    <div class="button-holder text-center">
                        <input class="btn btn-primary w-50" type="submit" id="login_user" value="Login">
                    </div>
                </form>
            </div>
        </div>

    </div>

    <?php include_once('Components/links.php'); ?>
    <script type="text/javascript">
  $(document).ready(function() {

    // Register 
    $("#register_user").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".registerform");
      
      var username = $form.find("#register_username").val();
      var password = $form.find("#register_password").val();
      var name = $form.find("#name").val();
      var adress = $form.find("#adress").val();
      var phone = $form.find("#phone").val();
      var email = $form.find("#email").val();

      $.ajax({
        url: 'server.php',
        method: 'post',
        data: {
            username: username,
            password: password,
            name: name,
            adress: adress,
            phone: phone,
            email: email,
            register:'true'
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
        }
      });
    });

    // Login 
    $("#login_user").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".loginform");
      
      var username = $form.find("#login_username").val();
      var password = $form.find("#login_password").val();

      $.ajax({
        url: 'server.php',
        method: 'post',
        data: {
            username: username,
            password: password,
            login:'true'
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();
    $('a[href="#login"]').click();
    function load_cart_item_number() {
      $.ajax({
        url: 'server.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>