<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])) header("Location:index.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Shiraz">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register User</title>
  <?php include_once('components/styles.php'); ?>
</head>

<body>
  <!-- Navbar start -->
  <?php include_once('components/nav.php'); ?>
  <!-- Navbar end -->

  <div class="container mt-5 mb-5 ">
    <div id="message"></div>
    <ul class="nav nav-tabs">
      <li><a data-toggle="tab" href="#deposit">Deposit</a></li>
      <li><a data-toggle="tab" href="#operations">Operations</a></li>
    </ul>
    <div class="tab-content mt-5">
      <div id="deposit" class="tab-pane fade in active">
        <h2 class="text-center">Deposit to your wallet </h2>
        <br>
        <form class="card walletCard">
          <p class="walletName">Dollar Wallet</p>
          <img src="assets/dollar.png">
          <div class="walletInfo" id="dollarWalletInfo">
          </div>
          <input type="number" class="inputcard" id="monyDollar" placeholder="Mony Deposit" value="">
          <input type="submit" class="cart_button btn btn-primary" id="push_dollar" value="Deposite">
        </form>
      </div>

      <div id="operations" class="tab-pane fade">
        <h2 class="text-center">Operations of your wallet</h2>
        <table class="table table-striped">
          <thead>
            <th>ID</th>
            <th>Card Number</th>
            <th>Operation</th>
            <th>Date</th>
          </thead>
          <tbody id="transactionInfo">

          </tbody>
        </table>
        <br>

      </div>
    </div>

  </div>

  <script src='assets/js/jquery.min.js'></script>
  <script src='assets/js/bootstrap.min.js'></script>
  <script type="text/javascript">
    $(document).ready(function() {


      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();
      load_wallet_info();
      load_wallet_transactions();
      $('a[href="#deposit"]').click();


      $('#push_dollar').on("click", function(e) {
        e.preventDefault();

        $.ajax({
          url: 'action.php',
          method: 'post',
          data: {
            monyDollar: $('#monyDollar').val(),
            wallet: 'dollar'
          },
          success: function(response) {
            $("#message").html(response);
            window.scrollTo(0, 0);
          }

        });
        load_wallet_info();
      });

      function load_wallet_info() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: {
            walletInfo: "walletInfo"
          },
          success: function(response) {
            $("#dollarWalletInfo").html(response);
          }
        });
      }

      function load_wallet_transactions() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: {
            transaction: "transaction"
          },
          success: function(response) {
            $("#transactionInfo").html(response);
          }
        });
      }
    });

    
    function load_cart_item_number() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function(response) {
            $("#cart-item").html(response);
          }
        });
      }
    

  </script>
</body>

</html>