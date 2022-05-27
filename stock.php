<?php
session_start();
ini_set("display_errors", "on");
$conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
}
if (!isset($_GET["id"])) {
    echo "No stock id specified";
    exit();
}


// get stock from db
$sql = "SELECT * FROM stock WHERE id = '" . $_GET["id"] . "'";
$result = $conn->query($sql);

$div = '
<div class="stockpage">
        <div class="stockpageimginfo">
            <img src="stocks/placeholder.png" alt="stock image" class="stockpageimage" width="512" height="512">
            <div class="stockpageinfo">
                <h1 class="stockname">stock name</h1>
                <h2 class="stockprice">$ stock price</h2>
                <!-- add picture to cart -->
                <div class="addtocart">
                
                    <form action="cart.php" method="post">
                        <input type="hidden" name="stockid" value="placeholderid">
                        <input type="hidden" name="stockname" value="placeholdername">
                        <input type="hidden" name="stockprice" value="placeholdername">
                        <input type="submit" value="add to cart" class="addtocartbutton"> 
                    </form>
                </div>
                <a href="profile.php?id=placeholderid" class="stockpageowner">
                    <h3 class="stockowner">@stock owner</h3>
                </a>
            </div>
        </div>
        <div class="stockpagedescription">
            DESCRIPTION
        </div>
    </div>
';

// change div to match stock


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $div = str_replace("placeholder.png", $row['image'], $div);
        $div = str_replace("placeholderid", $row['owner'], $div);
        $div = str_replace("stock name", $row['name'], $div);
        $div = str_replace("stock price", $row['price'], $div);
        $div = str_replace("DESCRIPTION", $row['description'], $div);
    }
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
    <header>
        <a href="index.php" class="logo"><image src="images/logo.png" alt="logo" class="logo" /></a>
        <div class="searchdiv">
            <form>
                <input class="searchbar" type="text" id="search" name="search" placeholder="Search">
                <button class="searchbutton" type="submit" name="search_button">Search</button>
            </form>
        </div>
        <a href="create_stock.php" class="headera"><button class="headerbutton" >Create</button></a>
        <a href="login.php" class="headera"><button class="headerbutton" >Login</button></a>
        <a href="register.php" class="headera"><button class="headerbutton" >Register</button></a>
        <img src="Profile_Pics/default64.png" class="profilepic">
    </header>
    <?php echo $div; ?>
</body>
</html>
