<?php
session_start();
ini_set("display_errors", "on");

$conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
    echo "hahahah db goes brrrrr";
}



if (isset($_SESSION['user'])) {

    if (isset($_POST["addtocart"])) {
        // add to cart_element table if not already in cart
        $stockid = $_POST["stockid"];
        $userid = $_SESSION['user'];
        $sql = "SELECT * FROM cart_element WHERE user_id = '$userid' AND stock_id = '$stockid'";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($result->num_rows > 0) {

        }
        else {
            $sql = "INSERT INTO cart_element (user_id, stock_id) VALUES ('$userid', '$stockid')";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            //echo "Added to cart";
        }
    }

    if (isset($_POST['delete'])) {
        // delete from cart_element table
        $stockid = $_POST['stockid'];
        $userid = $_SESSION['user'];
        $sql = "DELETE FROM cart_element WHERE user_id = '$userid' AND stock_id = '$stockid'";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        //echo "Deleted from cart";
    }

    $isloggedin = true;
    $id = $_SESSION['user'];
    

    $cartelems = array();
    // get all stock from ids in cart
    $sql = "SELECT * FROM stock WHERE id IN (SELECT stock_id FROM cart_element WHERE user_id = '$id')";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cartelems[] = $row;
        }
    } 

    $div = "
        <div class='cart'>
    ";

    foreach($cartelems as $cartelem) {
        
        
        $div .= "
            <div class='cart-element'>
                <div class='cart-element-image'>
                    <a href='stock.php?id=" . $cartelem['id'] . "'>
                        <img src='stocks/" . $cartelem['image'] . "'width='256' height='256'>
                    </a>
                </div>
                <div class='cart-element-desc'>
                    <div class='cart-element-name'>
                        " . $cartelem['name'] . "
                    </div>
                    <div class='cart-element-price'>
                        $" . $cartelem['price'] . ".00
                    </div>
                    <div class='cart-element-delete'>
                        <form action='cart.php' method='post'>
                            <input type='hidden' name='stockid' value='" . $cartelem['id'] . "'>
                            <input type='submit' name='delete' value='Delete'>
                        </form>
                    </div>
                </div>
            </div>";
    }

    $div .= "
        </div>";


// calculate total price
    $totalprice = 0;
    foreach($cartelems as $cartelem) {
        $totalprice += $cartelem['price'];
    }

    $div .= "
        <div class='cart-checkout'>
            <div class='cart-total'>
                Total: $" . $totalprice . "
            </div>
            <div class='cart-checkout-div'>
                <a href='checkout.php' >
                    <button class='cart-checkout-button'> Checkout </button>
                </a>
            </div>
        </div>
    ";

}
else {
    $isloggedin = false;
    $div = "
    <div class='row'>
        <div class='col-md-12'>
            <h3>You must be logged in to add to cart</h3>
        </div>";
    // redirect after 3 seconds
    header("refresh:3;url=login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SHOP</title>
    <link rel="stylesheet" href="./Style.css">
</head>
<body>
    <?php include_once("header.php"); ?>
    <?php echo $div; ?>


    <?php include_once("footer.php"); ?>
</body>
</html>