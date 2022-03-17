<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php require_once('../Controller/PresentationLayer/FunctionController.php'); ?>
<?php 

$result = FunctionController::getCheckout();
$grand_total = $result["grand_total"];
$allItems = $result["allItems"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <?php include_once('Components/styles.php'); ?>

  <style>
    .label {
      color: rgb(33 37 41 / 75%);
      margin-left: 5px;
      font-weight: 400;
    }

  </style>
  <script>
    function linkChanges(me, id) {
      $('#' + id).text($(me).val());
    }

    function checkout()
      {
        $.ajax({
          url: 'server.php',
          method: 'post',
          data: {
            fullName: $('#fullName').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            address: $('#address').val(),
            cardno: $('#cardno').val(),
            products: $('#products').val(),
            grand_total: $('#grand_total').val(),
            action: 'order'
          },
          success: function(response) {
            $("#message").html(response);
            window.scrollTo(0, 0);
            load_cart_item_number();
          }

        });

      }
  </script>
</head>

<body>
  <?php include_once('Components/nav.php'); ?>

  <div class="container">
  <div id="message"></div>
    <form action="" method="post" id="placeOrder">
      <!-- SmartWizard html -->
      <div id="smartwizard">
        <ul>
          <li><a href="#step-1">Step 1<br /><small>Personal Info</small></a></li>
          <li><a href="#step-2">Step 2<br /><small>Delivery Info</small></a></li>
          <li><a href="#step-3">Step 3<br /><small>Bill Details</small></a></li>
          <li><a href="#step-4">Step 4<br /><small>Confirmation</small></a></li>
        </ul>

        <div>
          <input type="hidden" name="products" id="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" id="grand_total" value="<?= $grand_total; ?>">
          <div id="step-1" class="">
            <br>
            <div class="form-group">
              <label class="label">Full Name:</label>
              <input type="text" name="name" id="fullName" class="form-control" placeholder="Enter Name" required onkeyup="linkChanges(this,'fullNameShow');">
            </div>
            <div class="form-group">
              <label class="label">Email:</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter E-Mail" required onkeyup="linkChanges(this,'emailShow');">
            </div>
            <div class="form-group">
              <label class="label">Phone:</label>
              <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter Phone" required onkeyup="linkChanges(this,'phoneShow');">
            </div>

          </div>

          <div id="step-2" class="">
            <div class="form-group">
              <label class="label">Delivery Address:</label>
              <textarea name="address" id="address" class="form-control" onkeyup="linkChanges(this,'addressShow');" rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
            </div>
            <div class="form-group">
              <label class="label">Card Number</label>
              <input type="number" name="cardno" id="cardno" class="form-control" placeholder="Enter Card Number" required onkeyup="linkChanges(this,'cardnoShow');">
            </div>
          </div>
          <div id="step-3" class="">
            <h4 class="text-center text-info p-2">Complete your order!</h4>
            <div class="jumbotron p-3 mb-2">
              <ul>
                <li>
                  <h6 class="lead">
                    <h3>Product(s) </h3>
                    <ol>
                      <li><?= $allItems; ?></li>
                    </ol>
                  </h6>
                </li>
                <br>
                <li>
                  <h5 class="lead">
                    <h3>Delivery Charge </h3>Free
                  </h5>
                </li>
                <br>
                <li>
                  <h5>
                    <h3>Total Amount Payable </h3><?= number_format($grand_total, 2) ?>/-
                  </h5>
                </li>
              </ul>
            </div>
          </div>
          <div id="step-4" class="">
            <h2>Step 4 Content</h2>
            <div class="panel panel-default">
              <div class="panel-heading">My Details</div>
              <table class="table">
                <tbody>
                  <tr>
                    <th>Your Name:</th>
                    <td id="fullNameShow"></td>
                  </tr>
                  <tr>
                    <th>Your Email:</th>
                    <td id="emailShow"></td>
                  </tr>
                  <tr>
                    <th>Your Phone:</th>
                    <td id="phoneShow"></td>
                  </tr>

                  <tr>
                    <th>Your Card No:</th>
                    <td id="cardnoShow"></td>
                  </tr>
                  <tr>
                    <th>Your Address:</th>
                    <td id="addressShow"></td>
                  </tr>
                  <tr>
                    <th>Total Amount Paid:</th>
                    <td>$<?= number_format($grand_total, 2) ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </form>

  </div>

  <?php include_once('Components/links.php'); ?>


  <script type="text/javascript">
    $(document).ready(function() {

      // Sending Form data to the server
      $("#placeOrder").submit(function(e) {
        e.preventDefault();
        $.ajax({
          url: 'server.php',
          method: 'post',
          data: $('form').serialize() + "&action=order",
          success: function(response) {
            $("#order").html(response);
          }
        });
      });
      



      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

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

      // Smart Wizard
      $('#smartwizard').smartWizard({
        selected: 0,
        transitionEffect: 'slide',
        toolbarSettings: {
          toolbarPosition: 'top',
          toolbarExtraButtons: [{
            label: 'Cancel',
            css: 'btn-danger',
            onClick: function() {
              $('#smartwizard').smartWizard("reset");
              location.href = "cart.php";
            }
          }]
        }
      });

      $('#smartwizard').smartWizard("theme", "arrows");

              
    });
  </script>
</body>

</html>