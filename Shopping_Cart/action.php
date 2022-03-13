<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'config.php';

// Add products into the cart table
if (isset($_POST['pid'])) {
	$pid = $_POST['pid'];
	$pname = $_POST['pname'];
	$pprice = $_POST['pprice'];
	$pimage = $_POST['pimage'];
	$pcode = $_POST['pcode'];
	$pqty = $_POST['pqty'];
	$total_price = $pprice * $pqty;

	$stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
	$stmt->bind_param('s', $pcode);
	$stmt->execute();
	$res = $stmt->get_result();
	$r = $res->fetch_assoc();
	$code = $r['product_code'] ?? '';
	if (!$code) {
		$query = $conn->prepare('INSERT INTO cart(product_name,product_price,product_image,qty,total_price,product_code) VALUES (?,?,?,?,?,?)');
		$query->bind_param('ssssss', $pname, $pprice, $pimage, $pqty, $total_price, $pcode);
		$query->execute();

		echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	} else {
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	}
}

// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	$stmt = $conn->prepare('SELECT * FROM cart');
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
	$id = $_GET['remove'];

	$stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	$stmt->bind_param('i', $id);
	$stmt->execute();

	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'Item removed from the cart!';
	header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
	$stmt = $conn->prepare('DELETE FROM cart');
	$stmt->execute();
	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'All Item removed from the cart!';
	header('location:cart.php');
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
	$qty = $_POST['qty'];
	$pid = $_POST['pid'];
	$pprice = $_POST['pprice'];

	$tprice = $qty * $pprice;

	$stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	$stmt->bind_param('isi', $qty, $tprice, $pid);
	$stmt->execute();
}

// Checkout and save customer info in the orders table
if (isset($_POST['action']) && isset($_POST['action']) == 'order') {

	$fullName = $_POST['fullName'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$cardno = $_POST['cardno'];
	$products = $_POST['products'];
	$grand_total = $_POST['grand_total'];
	$address = $_POST['address'];

	if(empty($fullName)||empty($email)||empty($phone)||empty($cardno)||
	empty($products)||empty($grand_total)||empty($address))
	{
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Fill All Fields Please !!!</strong>
						</div>';
		return;
	}

	$query = $conn->prepare("SELECT `mony` FROM `wallet` WHERE `card_id`=?");
	$query->bind_param('s', $cardno);
	$query->execute();
	$query->bind_result($mony);
	$query->store_result();
	$query->fetch();
	if(floatval($grand_total)>floatval($mony))
	{
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Your Order Cost More Than Mony In Your Wallet </strong>
						  <br>
						  <strong>Order Cost: $'.$grand_total.'  Mony In Your Wallet: $'.$mony.' </strong>
						</div>';
		return;
	}

	$stmt = $conn->prepare('INSERT INTO `orders`(`name`, `email`, `phone`, `address`, `products`, `amount_paid`, `card_id`) VALUES(?,?,?,?,?,?,?)');
	$stmt->bind_param('sssssss', $fullName, $email, $phone, $address, $products, $grand_total,$cardno);
	$stmt->execute();
	$stmt2 = $conn->prepare('DELETE FROM cart');
	$stmt2->execute();
	$stmt3 = $conn->prepare('UPDATE wallet SET mony=? WHERE card_id=?');
	$mony = (floatval($mony)-floatval($grand_total));
	$stmt3->bind_param('ss',$mony, $cardno);
	$stmt3->execute();
	echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Order Registered Success</strong>
						</div>';
	
}

// Register New User
if (isset($_POST['register']) && isset($_POST['register']) == 'true') {
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	$name = $_POST["name"];
	$adress = $_POST["adress"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];

	if (
		empty($username) || empty($password) || empty($name) ||
		empty($adress) || empty($phone) || empty($email)
	) {
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Fill All Fileds !!!!</strong>
						</div>';
		return;
	}


	$query = $conn->prepare("SELECT `username` FROM `user` WHERE `username` = ?");
	$query->bind_param('s', $username);
	$query->execute();
	$query->store_result();

	if ($query->num_rows() > 0) {
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Username is registered before !!</strong>
						</div>';
		return;
	} else {
		$query2 = $conn->prepare('INSERT INTO user(username,password,fullName,address,phone,email) VALUES (?,?,?,?,?,?)');
		$query2->bind_param('ssssss', $username, $password, $name, $adress, $phone, $email);
		$query2->execute();

		echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Register Completed ... now login</strong>
						</div>';
	}
}

// Login User
if (isset($_POST['login']) && isset($_POST['login']) == 'true') {
	$username = $_POST["username"];
	$password = md5($_POST["password"]);

	if (empty($username) || empty($password)) {
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Fill All Fileds !!!!</strong>
						</div>';
		return;
	}


	$query = $conn->prepare("SELECT `id`,`username` FROM `user` WHERE `username` = ? AND `password` = ?");
	$query->bind_param('ss', $username, $password);
	$query->execute();
	$query->bind_result($uid,$username);
	$query->store_result();
	$query->fetch();
	if ($query->num_rows() > 0) {
		$_SESSION['username'] = $username;
		$_SESSION['userID'] = $uid;
		echo "<script>location.href='account.php';</script>";
	} else {
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Invalid Credentials !!</strong>
						</div>';
	}
}

// Logout User
if (isset($_GET['logout']) && isset($_GET['logout']) == 'true') {
	session_destroy();
	header("Location:index.php");
	
}

// Setup User Wallet 
if (isset($_POST['wallet']) && isset($_POST['wallet']) == 'dollar') {
	
	$mony = $_POST["monyDollar"];
	$userID = $_SESSION['userID'];


	if($mony<=0 || !is_numeric($mony) || is_null($mony)){
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong> Not Accepted Mony Value !!!</strong>
						</div>';
		return;
	}


	$query = $conn->prepare("SELECT * FROM `wallet` WHERE `user_id` = ?");
	$query->bind_param('i', $userID);
	$query->execute();
	$query->bind_result($id,$user_id,$card_id,$monyReturn);
	$query->store_result();
	$query->fetch();

	if ($query->num_rows() > 0) {
		$mony = floatval($monyReturn)+ floatval($mony);
		$query2 = $conn->prepare('UPDATE wallet SET mony=? WHERE card_id=?');
		$query2->bind_param('ss', $mony, $card_id);
		$query2->execute();
		$query2->store_result();
		echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Wallet Updated Success</strong>
						</div>';
		return;
	} else {
		$card_id = '300'. mt_rand(1111111,9999999);
		$query2 = $conn->prepare('INSERT INTO wallet(user_id,card_id,mony) VALUES (?,?,?)');
		$query2->bind_param('iss', $userID,$card_id, $mony);
		$query2->execute();
		$query2->store_result();

		echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Your Wallet Created Success with wallet number: '.$card_id.' </strong>
						</div>';
	}

	
}

// Get User Wallet Info
if (isset($_GET['walletInfo']) && isset($_GET['walletInfo']) == 'walletInfo') {
	$stmt = $conn->prepare('SELECT * FROM wallet WHERE user_id=?');
	$stmt->bind_param('i',$_SESSION['userID']);
	$stmt->bind_result($id,$user_id,$card_id,$mony);
	$stmt->execute();
	$stmt->store_result();
	$stmt->fetch();
	
	if($stmt->num_rows()>0)
	{
		echo "<p >Wallet Mony: <span>$mony</span></p>
		<p >Wallet Number: <span>$card_id</span></p>";
	}
	else
	{
		echo "<p >Wallet Mony: <span style='color:red'>not set</span></p>
		<p >Wallet Number: <span style='color:red'>not set</span></p>";
	}
}
