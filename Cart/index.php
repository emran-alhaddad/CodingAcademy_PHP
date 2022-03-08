<?php
session_start();
require_once("pages/db.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>
            array('name'=>$productByCode[0]["name"], 
            'code'=>$productByCode[0]["code"], 
            'quantity'=>$_POST["quantity"], 
            'price'=>$productByCode[0]["price"], 
            'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
    case "edit":
        if(!empty($_GET["quantity"])) {
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($_GET["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($_GET["code"] == $k) {
								$_SESSION["cart_item"][$k]["quantity"] = $_GET["quantity"];
							}
					}
				} 
			} 
		}
	break;

	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <div class="container">
            <a href="#" class="logo">CompanyLogo</a>
            <a href="#" class="bag">
                <i class="fas fa-shopping-bag"></i>
                <?php	
                $total_quantity = 0;
                    if(isset($_SESSION["cart_item"]))	
                        foreach ($_SESSION["cart_item"] as $item)
                            $total_quantity += $item["quantity"];
                ?>
                <span class="quantity"><?php echo $total_quantity?></span>
            </a>
        </div>
    </header>
    <div class="cart">
        <a href="#" class="closecart"><i class="fas fa-times"></i></a>
        <div id="minicart">
            <table id="lista-carrito" class="u-full-width">
                <thead>
                <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Price</th>
                <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php	
                    if(isset($_SESSION["cart_item"]))
                    {
                        $total_quantity = 0;
                        $total_price = 0;	
                        foreach ($_SESSION["cart_item"] as $item)
                        {
                            $item_price = $item["quantity"]*$item["price"];
		        ?>

            
				<tr>
				<td>
                    <img src="productImages/<?php echo $item["image"]; ?>" width="50" height="50"> 
                    <br>
                <?php echo $item["name"]; ?></td>
				<td style="display:flex; flex-direction:row;"> 
                    <a href="#" onclick="changeQuantity(<?php echo $item['code']; ?>,-1);" class="arrowEdit" ><i class="fas fa-arrow-down"></i> </a>

                    <input class="quantityEdit" type="number" min=1 max=20 id="<?php echo $item["code"]; ?>" value="<?php echo $item["quantity"]; ?>" >

                    <a href="#" onclick="changeQuantity(<?php echo $item['code']; ?>,+1);" class="arrowEdit" ><i class="fas fa-arrow-up"></i></a>
                </td>
				<td><?php echo $item["price"]." YR"; ?></td>
				<td><?php echo number_format($item_price,2)." YR"; ?></td>
				<td><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="deletebtn">X</a></td>
				</tr>

				<?php
                            $total_quantity += $item["quantity"];
                            $total_price += ($item["price"]*$item["quantity"]);
                        }
                ?>
                        <td>TOTALS</td>
                        <td><?php echo $total_quantity ?></td>
                        <td></td>
                        <td><?php echo $total_price ?></td>
                <?php

                    }
                ?>
                    
                </tbody>
            </table>
            <a href="index.php?action=empty" id="vaciar-carrito" class="button u-full-width">
                Clean Cart <i class="far fa-trash-alt"></i>
                	
            </a>
        </div>
    </div>
    
    <h1>EXPLORE THE COLLECTION</h1>
    <div class="cards container">
        <?php
            $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
            if (!empty($product_array)) { 
                // for($i=0; $i<3; $i++)
                foreach($product_array as $key=>$value){
        ?>
        <form class="card" method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                <img src="productImages/<?php echo $product_array[$key]["image"]; ?>" alt="">
                <p class="title" ><?php echo $product_array[$key]["name"]; ?></p>
                <p class="price" ><?php echo $product_array[$key]["price"]." YR"; ?></p>
                <input type="hidden" name="quantity" value=1>
                <button class="button" type="submit">Add to Card</button>
        </form>
        
        <?php
		    } }
        ?>
    </div>

    <script src="js/main.js"></script>
    <script>

        
    </script>

</body>

</html>