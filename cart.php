<?php

if (isset($_POST["addtocart"])) {
    $stockid = $_POST['stockid'];
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    $cart = $_SESSION["cart"];
    array_push($cart, $stockid);
}
?>