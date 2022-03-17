<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php require_once('../Controller/PresentationLayer/FunctionController.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cart</title>
  <?php include_once('Components/styles.php'); ?>
</head>

<body>
  <?php include_once('Components/nav.php'); ?>

  <div id="message"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                              echo $_SESSION['showAlert'];
                            } else {
                              echo 'none';
                            }
                            unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                  }
                  unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="7">
                  <h4 class="text-center text-info m-0">Products in your cart!</h4>
                </td>
              </tr>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>
                  <a href="server.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php FunctionController::showCartProducts(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include_once('Components/links.php'); ?>


  <script type="text/javascript">
    $(document).ready(function() {

      // Change the item quantity
      $(".itemQtyPlus").on("click", function() {
        var $el = $(this).closest('tr');
        var qt = Number($el.find(".itemQty").val());
        qt++;
        $el.find(".itemQty").val(qt);
        $el.find(".itemQty").change();
      })

      $(".itemQtyMinus").on("click", function() {
        var $el = $(this).closest('tr');
        var qt = Number($el.find(".itemQty").val());
        if (qt <= 1) return;
        qt--;
        $el.find(".itemQty").val(qt);
        $el.find(".itemQty").change();
      })

      $(".itemQty").on('change', function() {
        var $el = $(this).closest('tr');

        var pid = $el.find(".pid").val();
        var pprice = $el.find(".pprice").val();
        var qty = $el.find(".itemQty").val();
        location.reload(true);
        $.ajax({
          url: 'server.php',
          method: 'post',
          cache: false,
          data: {
            qty: qty,
            pid: pid,
            pprice: pprice
          },
          success: function(response) {
            // $("#message").html(response);
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
    });
  </script>
</body>

</html>