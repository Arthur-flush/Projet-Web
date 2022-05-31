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
            <div class="downloadpdf">
                <button class="pdfbutton" id="pdfbutton" onclick="location.href = \'generate_pdf.php?id=placeholderstockid\'">
                    <label for="pdfbutton" class="downloadpdflabel">Download PDF</label>
                </button>
            </div>
            
            <img src="stocks/placeholder.png" alt="stock image" class="stockpageimage" width="512" height="512">
            <div class="stockpageinfo">
                <h1 class="stockpagestockname">stock name</h1>
                <h2 class="stockpagestockprice">$stock price.00</h2>
                <!-- add picture to cart -->
                <div class="addtocart">
                
                    <form action="cart.php" method="post">
                        <input type="hidden" name="stockid" value="placeholderstockid">
                        <input type="hidden" name="stockname" value="placeholdername">
                        <input type="hidden" name="stockprice" value="stock price">
                        <input type="submit" name="addtocart" value="add to cart" class="addtocartbutton"> 
                    </form>
                </div>
                delete
                <a href="profile.php?id=placeholderid" class="stockpageowner">
                    <h3 class="stockowner">@stock owner</h3>
                </a>
                <!-- rating button-->
                <div class="ratingbutton">
                    <form action="rating.php" method="post">
                        <input type="hidden" name="stockid" value="placeholderstockid">
                        <input type="hidden" name="stockname" value="placeholdername">
                        <input type="hidden" name="stockprice" value="placeholdername">
                        <script>
                            function toggleStar(element) {
                                var star = element.parentNode.getElementsByTagName("label");
                                for (var i = 0; i < 5; i++) {
                                    star[i].checked = false;
                                }
                                element.checked = true;

                                for (var i = 0; i < element.value; i++) {
                                    star[i].style.backgroundImage = "url(./images/star-solid-24-checked.png)";
                                }

                                for (var i = element.value; i < 5; i++) {
                                    star[i].style.backgroundImage = "url(./images/star-solid-24-unchecked.png)";
                                }
                            }
                        </script>
                        <div class="stars">
                            <input type="radio" id="star1" name="rating" value="1" onchange="toggleStar(this)">
                            <label for="star1"></label>
                            <input type="radio" id="star2" name="rating" value="2" onchange="toggleStar(this)">
                            <label for="star2"></label>
                            <input type="radio" id="star3" name="rating" value="3" onchange="toggleStar(this)">
                            <label for="star3"></label>
                            <input type="radio" id="star4" name="rating" value="4" onchange="toggleStar(this)">
                            <label for="star4"></label>
                            <input type="radio" id="star5" name="rating" value="5" onchange="toggleStar(this)">
                            <label for="star5"></label>
                            
                        </div>
                        <input type="submit" value="rate" class="ratingbutton"> 
                        <script>
                            var rating = ratingval;
                            if (rating != 0) {
                                var star = document.getElementById("star" + rating);
                                toggleStar(star);
                            }
                        </script>
                    </form>
                </div>
                <div class="stockpageinfotags">
                    <h3 class="stocktags">#tags</h3>
                </div>
                
            </div>
        </div>
        <div class="stockpagedescription">
            DESCRIPTION
        </div>
    </div>
';

// change div to match stock

$deleteform = '
<form action="delete_item.php" method="post" class="deletestock">
    <input type="hidden" name="stockid" value="placeholderid">
    <input type="submit" value="delete" class="deletestockbutton">
</form>
';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $div = str_replace("placeholder.png", $row['image'], $div);
        $div = str_replace("placeholderid", $row['owner'], $div);
        $div = str_replace("stock name", $row['name'], $div);
        $div = str_replace("stock price", $row['price'], $div);
        $div = str_replace("DESCRIPTION", $row['description'], $div);
        $div = str_replace("placeholdername", $row['name'], $div);
        $div = str_replace("placeholderstockid", $row['id'], $div);
        //get owner handle;
        $sql = "SELECT handle FROM users WHERE id = '" . $row['owner'] . "'";
        $result2 = $conn->query($sql);
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $div = str_replace("stock owner", $row2['handle'], $div);
            }
        }

        // get tags
        $tags = $row['tags'];
        $tags = explode(",", $tags);
        $tagstring = "<div class='displaytags'> ";
        foreach ($tags as $tag) {
            $tagstring .= "<div class='displaytag'> <img src='./images/tag checked.png' alt='tag'  width='24' height='24' > <div class='displaytaglabel'>" . $tag . "</div></div>";
        }
        $tagstring .= "</div>";

        $div = str_replace("#tags", $tagstring, $div);
        
        $deleteform = str_replace("placeholderid", $row['id'], $deleteform);

        // get average rating for item from db
        $sql = "SELECT AVG(rating) FROM rating WHERE stock_id = '" . $row['id'] . "'";
        $result2 = $conn->query($sql);
        if (!$result2) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $rating = intval(round($row2['AVG(rating)']));
                if ($rating != null) 
                    $div = str_replace("ratingval", $rating, $div);
                else 
                    $div = str_replace("ratingval", 0, $div);
            }
        }
        else {
            $div = str_replace("ratingval", "0", $div);
        }

    }
}

if (isset($_SESSION['user'])) {
    $isloggedin = true;
    $id = $_SESSION['user'];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['admin'] == 1) {
                $admin = true;
            }
            else {
                $admin = false;
            }

            // get if stock owner is current user
            if ($row['id'] == $_GET['id']) {
                $owner = true;
            }
            else {
                $owner = false;
            }
        }
    }
    else {
        $owner = false;
        $admin = false;
    }

    if ($admin or $owner) {
        $div = str_replace("delete", $deleteform, $div);
    }
    else {
        $div = str_replace("delete", "", $div);
    }

}
else {
    $isloggedin = false;
    $div = str_replace("delete", "", $div);
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
    <div class="content">
        <?php echo $div; ?>
    </div>
    <?php include_once("footer.php"); ?>
    
</body>
</html>
