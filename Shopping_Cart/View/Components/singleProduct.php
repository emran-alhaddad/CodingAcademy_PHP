<?php

function showProduct($row)
{
    echo "
    <div class='col-sm-6 col-md-4 col-lg-3 mb-2'>
    <div class='card-deck'>
      <div class='card p-2 border-secondary mb-2'>
        <img src='Product_Images/".$row['product_image']."' class='card-img-top' height='250'>
        <div class='card-body p-1'>
          <h4 class='card-title text-center text-info'>".$row['product_name']."</h4>
          <h5 class='card-text text-center text-danger'><i class='fas fa-dollar-sign'></i>&nbsp;&nbsp;".number_format($row['product_price'],2)." /-</h5>

        </div>
        <div class='card-footer p-1'>
          <form action='' class='form-submit'>
            <div class='row p-2'>
              <div class='col-md-6 py-1 pl-4'>
                <b>Quantity : </b>
              </div>
              <div class='col-md-6'>
                <input type='number' min=1 required class='form-control pqty' value='".$row['product_qty']."'>
              </div>
            </div>
            <input type='hidden' class='pid' value='". $row['id']."'>
            <input type='hidden' class='pname' value='".$row['product_name']."'>
            <input type='hidden' class='pprice' value='".$row['product_price']."'>
            <input type='hidden' class='pimage' value='".$row['product_image']."'>
            <input type='hidden' class='pcode' value='".$row['product_code']."'>
            <button class='btn btn-info btn-block addItemBtn'><i class='fas fa-cart-plus'></i>&nbsp;&nbsp;Add to
              cart</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  ";
}

