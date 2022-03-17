<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php
require_once('../Controller/DataAccessLayer/DBController.php');
require_once('../Controller/PresentationLayer/FunctionController.php');
require_once('../Model/Product.php');
require_once('../Model/Order.php');
require_once('../Model/User.php');
require_once('../Model/Wallet.php');


// Add products into the cart table
if (isset($_POST['pid'])) {
	$product = new Product($_POST['pid'], $_POST['pname'], $_POST['pprice'], $_POST['pqty'], $_POST['pimage'], $_POST['pcode']);
	FunctionController::addToCart($product);
}

// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	FunctionController::getCart();
}

// Remove single items from cart
if (isset($_GET['remove'])) {
	FunctionController::removeCartItem($_GET['remove']);
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
	FunctionController::emptyCart();
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
	FunctionController::updateCartProductQuantity($_POST['qty'], $_POST['pid'], $_POST['pprice']);
}

// Checkout and save customer info in the orders table
if (isset($_POST['action']) && isset($_POST['action']) == 'order') {

	$order = new Order(
		$_POST['fullName'],
		$_POST['email'],
		$_POST['phone'],
		$_POST['address'],
		$_POST['products'],
		$_POST['grand_total'],
		$_POST['cardno'],
		date('d/m/Y H:i:s')
	);

	FunctionController::checkout($order);
}

// Register New User
if (isset($_POST['register']) && isset($_POST['register']) == 'true') {
	$user = new User(
		0,
		$_POST["username"],
		md5($_POST["password"]),
		$_POST["name"],
		$_POST["adress"],
		$_POST["phone"],
		$_POST["email"]
	);

	FunctionController::registerUser($user);
}

// Login User
if (isset($_POST['login']) && isset($_POST['login']) == 'true') {

	$user = new User(0, $_POST["username"], md5($_POST["password"]));
	FunctionController::loginUser($user);
}

// Logout User
if (isset($_GET['logout']) && isset($_GET['logout']) == 'true') {

	FunctionController::logout();
}

// Setup User Wallet 
if (isset($_POST['wallet']) && isset($_POST['wallet']) == 'dollar') {

	$wallet = new Wallet(userId: $_SESSION['userID'], mony: $_POST["monyDollar"]);
	FunctionController::setupWallet($wallet);
}

// Get User Wallet Info
if (isset($_GET['walletInfo']) && isset($_GET['walletInfo']) == 'walletInfo') {

	FunctionController::getUserWalletInfo(new Wallet(userId: $_SESSION['userID']));
}

// Get User User Transactions
if (isset($_GET['transaction']) && isset($_GET['transaction']) == 'transaction') {
	$card_id = -999;
	if(isset($_SESSION['card_id'])) $card_id = $_SESSION['card_id'];
	FunctionController::getCardTransactions($card_id);
}
