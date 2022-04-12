<?php
ini_set("display_errors", "on");
$conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
}
//echo 'Connected successfully';
$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>SHOP</title>
    <link rel="stylesheet" href="./Style.css?random=@Environment.TickCount">
</head>
<body>

    <header>
        <div class="logo">
            ARTCHAD NFT
        </div>
        <form class="searchdiv">
            <input class="searchbar" type="text" name="search">
            <button class="searchbutton" type="submit" onclick="">Search</button>
        </form>

        <button class="loginbutton" type="submit">Connect</button>
    </header>
    <div id="sidebar" class="sidebar">
        <div>
            what is this
        </div>
    </div>

    <div id="main" class="main"> 
        <button id="navbutton" class="openbtn" onclick="openNav()">&#9776;</button>

        <div class="item">
            <div class="item-image">
                <img src="" alt="">
            </div>
            <div class="item-info">
                <div class="item-name">
                    <h1>
                        <a href="">
                        </a>
                    </h1>
                </div>
                <div class="item-price">
                    <h2>
                        <a href="">
                        </a>
                    </h2>
                </div>
            </div>
        </div>

    </div>

    <script src="index.js" > </script>
</body>
</html>