<?php
session_start();
ini_set("display_errors", "on");
$conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
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
            $ stock price 
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
    <body>
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

        </div>
    </body>
    <footer>

    </footer>
</body>

</html>