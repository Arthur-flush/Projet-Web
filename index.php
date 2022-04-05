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
    <link rel="stylesheet" href="Style.css">
</head>
<body>

    <header>
        <div class="logo">
            ARTCHAD NFT
        </div>
        <form class="searchdiv">
            <input class="searchbar" type="text" name="search" placeholder="Search">
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
        <div >

        </div>
    </div>

    <script src="index.js" > </script>
</body>
</html>