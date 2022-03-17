<?php

function showCartItem($row)
{
    $price = number_format($row['product_price'], 2);
    echo"
    <tr>
        <td>".$row['id']."</td>
        <input type='hidden' class='pid' value='".$row['id']."'>
        <td><img src='Product_Images/".$row['product_image']."' width='50'></td>
        <td>".$row['product_name']."</td>
        <td>
        <i class='fas fa-dollar-sign'></i>&nbsp;&nbsp;".$price." 
        </td>
        <input type='hidden' class='pprice' value='".$row['product_price']."'>
        <td>
            <div class='qty d-flex'>
            <button class='btn-minus btn-danger itemQtyMinus'><i class='fa fa-minus'></i></button>
            <input type='number' class='form-control itemQty' disabled value='".$row['qty']."' style='width:70px;'>
            <button class='btn-plus btn-primary itemQtyPlus'><i class='fa fa-plus'></i></button>
            </div>
        </td>
        <td><i class='fas fa-dollar-sign'></i>&nbsp;&nbsp;".number_format($row['total_price'], 2)." </td>
        <td>
            <a href='server.php?remove=".$row['id']."' class='text-danger lead' onclick='return confirm('Are you sure want to remove this item?');'><i class='fas fa-trash-alt'></i></a>
        </td>
    </tr>
    ";
}


function showCartFooter($grand_total,$checkout)
{
    $total = number_format(floatval($grand_total), 2);
    
    $disabled = "disabled";
    if($grand_total > 1 && $checkout) $disabled="";
    echo "
            <tr>
                <td colspan='3'>
                <a href='index.php' class='btn btn-success'><i class='fas fa-cart-plus'></i>&nbsp;&nbsp;Continue
                    Shopping</a>
                </td>
                <td colspan='2'><b>Grand Total</b></td>
                <td><b><i class='fas fa-dollar-sign'></i>&nbsp;&nbsp; ".$total."</b></td>
                <td>
                <a href='checkout.php' class='btn btn-info $disabled'><i class='far fa-credit-card'></i>&nbsp;&nbsp;Checkout</a>
                </td>
                
            </tr>
    ";
}

?>


