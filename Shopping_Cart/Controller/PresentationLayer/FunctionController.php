<?php

require_once('../Controller/BusinessLayer/TableController.php');
require_once('../Model/Product.php');
require_once('../Model/Order.php');
require_once('../Model/User.php');
require_once('../Model/Wallet.php');
require_once('../View/Components/Alert.php');
require_once('../View/Components/singleProduct.php');
require_once('../View/Components/singleCartItem.php');
require_once('../View/Components/walletInfo.php');
require_once('../View/Components/transactionRow.php');
require_once('../View/Components/redirect.php');


final class FunctionController
{

    public static function addNewProduct()
    {
    }

    public static function addToCart($product)
    {
        if (!is_numeric($product->productQuantity) || $product->productQuantity <= 0) {
            faildAlert('Invalid Product Quantity !!!');
            return;
        }

        $total_price = $product->productPrice * $product->productQuantity;
        $result = TableController::getTable('cart', "product_code='$product->productCode'");
        if ($result->num_rows <= 0) {
            TableController::insertInto(
                'cart',
                [
                    "product_name" => "'$product->productName'",
                    "product_price" => "'$product->productPrice'",
                    "product_image" => "'$product->productImage'",
                    "qty" => "'$product->productQuantity'",
                    "total_price" => "'$total_price'",
                    "product_code" => "'$product->productCode'",
                ]
            );

            successAlert('Item added to your cart!');
        } else {
            faildAlert('Item already added to your cart!');
        }
    }

    public static function getCart()
    {
        echo TableController::getTable('cart')->num_rows;
    }

    public static function getCheckout()
    {
        $fields = "CONCAT(product_name, '(',qty,')') AS ItemQty, total_price";
        $result = TableController::getTableFields('cart', $fields);
        $grand_total = 0;
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $grand_total += $row['total_price'];
            $items[] = $row['ItemQty'];
        }
        $allItems = implode('</li><li>', $items);

        return ["grand_total" => $grand_total, "allItems" => $allItems];
    }

    public static function showCartProducts()
    {
        $result = TableController::getTable('cart');
        $grand_total = 0;
        while ($row = $result->fetch_assoc()) {
            showCartItem($row);
            $grand_total += $row['total_price'];
        }
        $checkout = true;
        showCartFooter($grand_total, $checkout);
    }


    public static function removeCartItem($id)
    {
        TableController::deleteFrom('cart', "id=$id");
        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'Item removed from the cart!';
        redirect('cart.php');
    }

    public static function emptyCart()
    {
        TableController::deleteFrom('cart');
        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'All Item removed from the cart!';
        redirect('cart.php');
    }

    public static function updateCartProductQuantity($qty, $pid, $pprice)
    {
        if (is_numeric($qty) && $qty > 0) {
            $tprice = $qty * $pprice;
            TableController::updateFrom('cart', ['qty' => "$qty", 'total_price' => "'$tprice'"], "id=$pid");
        } else
            faildAlert("Invalid Quantity !!!");
    }

    public static function checkout($order)
    {
        $fullName = $order->userFullName;
        $email = $order->userEmail;
        $phone = $order->userPhone;
        $cardno = $order->cardId;
        $products = $order->userProduct;
        $grand_total = $order->amountPaid;
        $address = $order->userAddress;

        if (
            !$fullName || !$email || !$phone || !$cardno ||
            !$products || !$grand_total || !$address
        ) {
            faildAlert('Fill All Fields Please !!!');
            return;
        }

        $result = TableController::getTable('wallet', "card_id='$cardno'");
        $mony = $result->num_rows > 0 ? $result->fetch_assoc()['mony'] : 0;

        if (floatval($grand_total) > floatval($mony)) {
            faildAlert("Your Order Cost More Than Mony In Your Wallet <br> Order Cost: $$grand_total  Mony In Your Wallet: $$mony ");
            return;
        }

        TableController::insertInto('orders', [
            "name" => "'$order->userFullName'",
            "email" => "'$order->userEmail'",
            "phone" => "'$order->userPhone'",
            "address" => "'$order->userAddress'",
            "products" => "'$order->userProduct'",
            "amount_paid" => "'$order->amountPaid'",
            "card_id" => "'$order->cardId'",
            "date" => "'$order->orderDate'",
        ]);

        TableController::deleteFrom('cart');

        $mony = (floatval($mony) - floatval($grand_total));
        TableController::updateFrom('wallet', ['mony' => "'$mony'"], "card_id='$cardno'");

        $body = $fullName . ' Paid ( $' . $grand_total . ' ) For Buy This Products: <ul><li>' . $products . '</li></ul>';
        TableController::insertInto('transaction', [
            "card_id" => "'$cardno'", "body" => "'$body'", "date" => "'$order->orderDate'"
        ]);

        $msg = ' Order Registered Success <script> setInterval(function () {location.href="index.php"}, 2000); </script>';
        successAlert($msg);
    }

    public static function showProducts()
    {
        $result = TableController::getTable('product');
        while ($row = $result->fetch_assoc())
            showProduct($row);
    }

    public static function registerUser($user)
    {
        if (
            !$user->userName || !$user->password || !$user->fullName ||
            !$user->address || !$user->phone || !$user->email
        ) {

            faildAlert('Fill All Fields Please !!!');
            return;
        }

        $result = TableController::getTable('user', "username='$user->userName'");

        if ($result->num_rows > 0) {
            faildAlert('This username registered before !!');
            return;
        } else {

            TableController::insertInto('user', [
                "username" => "'$user->userName'",
                "password" => "'$user->password'",
                "fullName" => "'$user->fullName'",
                "address" => "'$user->address'",
                "phone" => "'$user->phone'",
                "email" => "'$user->email'",
            ]);

            successAlert('Register Completed ... now login');
            return;
        }
    }

    public static function loginUser($user)
    {

        if (!$user->userName || !$user->password) {
            faildAlert('Fill All Fileds Please !!!!');
            return;
        }

        $result = TableController::getTable('user', "username='$user->userName' AND password='$user->password'");
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            $_SESSION['username'] = $user->userName;
            $_SESSION['userID'] = $result['id'];
            redirect('account.php');
        } else {
            faildAlert('Invalid Credentials !!');
        }
    }

    public static function logout()
    {
        session_destroy();
        redirect('index.php');
    }

    public static function setupWallet($wallet)
    {
        if ($wallet->mony <= 0 || !is_numeric($wallet->mony) || is_null($wallet->mony)) {
            faildAlert('Not Accepted Mony Value !!!');
            return;
        }

        $result = TableController::getTable('wallet', "user_id=$wallet->userId");
        $body = "You ";


        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            $body .= 'Deposite ( $' . $wallet->mony . ' ) To Wallet with Number ( ' . $result['card_id'] . ' ) ';
            $wallet->mony = floatval($result['mony']) + floatval($wallet->mony);
            $body .= '   Now You Have ( $' . $wallet->mony . ' ) In Your Wallet';
            $wallet->cardId = $result['card_id'];
            TableController::updateFrom('wallet', ["mony" => "'$wallet->mony'"], "card_id='$wallet->cardId'");

            successAlert('Wallet Updated Success');
        } else {
            $wallet->cardId = '300' . mt_rand(1111111, 9999999);
            TableController::insertInto('wallet', [
                "user_id" => "$wallet->userId",
                "card_id" => "'$wallet->cardId'",
                "mony" => "'$wallet->mony'"
            ]);
            $body .= 'Create Your Own Wallet With Number ( ' . $wallet->cardId . ') and Deposite ( $' . $wallet->mony . ' ) To Your Wallet';
            successAlert("Your Wallet Created Success with wallet number:  $wallet->cardId ");
        }

        TableController::insertInto('transaction', [
            "card_id" => "'$wallet->cardId'", "body" => "'$body'", "date" => "'" . date('d/m/Y H:i:s') . "'"
        ]);
    }

    public static function getUserWalletInfo($wallet)
    {
        $result = TableController::getTable('wallet', "user_id='$wallet->userId'");

        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            $wallet->cardId = $result['card_id'];
            $wallet->mony = $result['mony'];
            $_SESSION['card_id'] = $wallet->cardId;
            showWalletCardInfo('$' . $wallet->mony, $wallet->cardId);
        } else {
            showWalletCardInfo("not set", "not set");
        }
    }

    public static function getCardTransactions($card_id)
    {
        $result = TableController::getTable('transaction', "card_id='$card_id'");

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $key => $value)
                showTransactionRow($value);
        } else {
            echo "<tr style='color:red; text-align:center;'><td colspan=4>No Transactions Yet !!!</td></tr>";
        }
    }
}
