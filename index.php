<?php
session_start();
ini_set("display_errors", "on");
$conn = new mysqli("172.27.0.3", "ProjetWeb", "scam.com", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
}

// get latest 5 stocks from db
$sql = "SELECT * FROM stock ORDER BY created_at DESC, id DESC LIMIT 5";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stocks = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $stocks[] = $row;
    }
}

$stockdiv = '
<div class="stock">
    <div class="stockimage">
        <a href="stock.php?id=placeholderid">
            <image src="stocks/placeholder.png" width="200" height="200">
        </a>
    </div>
    <div class="stockinfo">
        <div class="stockname">
            stock name
        </div>
        <div class="stockprice">
            $stock price.00
        </div>
        <div class="stockowner">
            <a href="profile.php?ownerid" class="handlelink">
                @stock owner
            </a>
        </div>
    </div>
</div>'
;

// create div for each stock
$stockdivs = array();
for ($i = 0; $i < count($stocks); $i++) {
    $stockdivs[$i] = str_replace("placeholder.png", $stocks[$i]['image'], $stockdiv);
    $stockdivs[$i] = str_replace("placeholderid", $stocks[$i]['id'], $stockdivs[$i]);
    $stockdivs[$i] = str_replace("stock name", $stocks[$i]['name'], $stockdivs[$i]);
    $stockdivs[$i] = str_replace("stock price", $stocks[$i]['price'], $stockdivs[$i]);
    $ownerid = $stocks[$i]['owner'];
    $stockdivs[$i] = str_replace("ownerid", $ownerid, $stockdivs[$i]);
    $sql = "SELECT * FROM users WHERE id = '$ownerid'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $stockdivs[$i] = str_replace("stock owner", $row['handle'], $stockdivs[$i]);
        }
    }

}

// get 50 stocks from db
$sql = "SELECT * FROM stock ORDER BY created_at DESC, id DESC LIMIT 50";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stocks = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $stocks[] = $row;
    }
}

$browsediv = '
<div class="stock stockbrowse">
    <div class="stockimage">
        <a href="stock.php?id=placeholderid">
            <image src="stocks/placeholder.png" width="200" height="200">
        </a>
    </div>
    <div class="stockinfo">
        <div class="stockname">
            stock name
        </div>
        <div class="stockprice">
            $stock price.00
        </div>
        <div class="stockowner">
            <a href="profile.php?ownerid" class="handlelink">
                @stock owner
            </a>
        </div>
    </div>
</div>
';

$browsedivs = array();
for ($i = 0; $i < count($stocks); $i++) {
    $browsedivs[$i] = str_replace("placeholder.png", $stocks[$i]['image'], $browsediv);
    $browsedivs[$i] = str_replace("placeholderid", $stocks[$i]['id'], $browsedivs[$i]);
    $browsedivs[$i] = str_replace("stock name", $stocks[$i]['name'], $browsedivs[$i]);
    $browsedivs[$i] = str_replace("stock price", $stocks[$i]['price'], $browsedivs[$i]);
    $ownerid = $stocks[$i]['owner'];
    $browsedivs[$i] = str_replace("ownerid", $ownerid, $browsedivs[$i]);
    $sql = "SELECT * FROM users WHERE id = '$ownerid'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $browsedivs[$i] = str_replace("stock owner", $row['handle'], $browsedivs[$i]);
        }
    }

}

//echo 'Connected successfully';
$conn->close();



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
        <div class="content">
            <div class="divider">
                Latest
            </div>
            <div id="latest" class="latest">
                <?php
                foreach ($stockdivs as $stockdiv) {
                    echo $stockdiv;
                }  
                ?>
            
        </div>
        <div class="divider">
            Browse
        </div>
        <div class="browse">
            <?php
                foreach ($browsedivs as $browsediv) {
                    echo $browsediv;
                }  
                ?>
        </div>
        
        <?php include_once("footer.php"); ?>
    </div>
    </body>

</html>