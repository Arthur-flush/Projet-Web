<?php
    session_start();
    ini_set("display_errors", "on");
    $conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
    if(! $conn ) {
        die('Could not connect to db');
    }

    if (!isset($_POST["search"])) {
        header('Location: index.php');
    }

    if (isset($_POST["nameordesc"])) { // general search in both the item name and description
        $search = $_POST["nameordesc"];
        $sql = "SELECT * FROM stock WHERE name LIKE '%$search%' OR description LIKE '%$search%' ORDER BY created_at DESC, id DESC LIMIT 50";
    }
    else { // specific search in all fields
        $namecontains = $_POST["namecontains"];
        $descriptioncontains = $_POST["descriptioncontains"];
        $pricemin = $_POST["pricemin"];
        $pricemax = $_POST["pricemax"];
        if (isset($_POST['tag'])) {
            $tags = $_POST['tag']; // array of tags
            if ($tags == "") {
                $tags = array();
            }
            $tagcontains = implode(",", $tags);
        }
        else {
            $tagcontains = "";
        }
        $ownername = $_POST["owner"];
        $createdafter = $_POST["createdafter"];
        $createdbefore = $_POST["createdbefore"];
        $ratingmin = $_POST["ratingmin"];
        $ratingmax = $_POST["ratingmax"];

        // get owner id from ownername
        $sql = "SELECT id FROM users WHERE handle = '$ownername'";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $owner = $row['id'];
            }
        }
        else {
            $owner = "";
        }
        
        
        if ($ratingmin != "" or $ratingmax != "") {
            $sql = "SELECT * FROM stock JOIN rating ON rating.stock_id = stock.id WHERE ";
        }
        else {
            $sql = "SELECT * FROM stock WHERE ";
        }
        
        $where = false;
        if ($namecontains != "") {
            $where = true;
            $sql .= "name LIKE '%$namecontains%' AND ";
        }
        if ($descriptioncontains != "") {
            $where = true;
            $sql .= "description LIKE '%$descriptioncontains%' AND ";
        }
        if ($pricemin != "") {
            $where = true;
            $sql .= "price >= $pricemin AND ";
        }
        if ($pricemax != "") {
            $where = true;
            $sql .= "price <= $pricemax AND ";
        }
        if ($tagcontains != "") {
            $where = true;
            // for each tag
            $sql .= "(";
            $tags = explode(",", $tagcontains);
            foreach ($tags as $tag) {
                $sql .= "tags LIKE '%$tag%' AND ";
            }
            $sql = substr($sql, 0, -5);
            $sql .= ") AND ";
        }
        if ($owner != "") {
            $where = true;
            $sql .= "owner = '$owner' AND ";
        }
        if ($createdafter != "") {
            $where = true;
            $sql .= "stock.created_at >= '$createdafter' AND ";
        }
        if ($createdbefore != "") {
            $where = true;
            $sql .= "stock.created_at <= '$createdbefore' AND ";
        }
        if ($where) {
            $sql = substr($sql, 0, -5);
        }
        else {
            $sql = substr($sql, 0, -7);
        }

        $rating = false;
        if ($ratingmin != "") {
            $rating = true;
            $sql .= "HAVING AVG(rating.rating) >= $ratingmin ";
        }
        if ($ratingmax != "") {
            if ($rating) {
                $sql .= "AND ";
            }
            else {
                $sql .= "HAVING ";
            }
            $sql .= "AVG(rating.rating) <= $ratingmax ";
        }
        
    }

    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $itemdivtemplate = '
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

    $div = '
        <div class="browse">
    ';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $name = $row["name"];
            $price = $row["price"];
            $image = $row["image"];
            $description = $row["description"];
            $tags = $row["tags"];
            $created_at = $row["created_at"];
            $ownerid = $row["owner"];

            // get owner handle from db
            $ownerresult = $conn->query("SELECT handle FROM users WHERE id='$ownerid'");
            if (!$ownerresult) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $ownerrow = $ownerresult->fetch_assoc();
            $ownerhandle = $ownerrow["handle"];

            $div .= str_replace("placeholderid", $id, $itemdivtemplate);
            $div = str_replace("stock name", $name, $div);
            $div = str_replace("stock price", $price, $div);
            $div = str_replace("stock owner", $ownerhandle, $div);
            $div = str_replace("placeholder.png", $image, $div);
            $div = str_replace("stock description", $description, $div);
            $div = str_replace("stock tags", $tags, $div);
            $div = str_replace("stock created_at", $created_at, $div);
            $div = str_replace("ownerid", $ownerid, $div);
        }
    }
    else {
        $div .= '
            <div class="stock stockbrowse">
                <div class="stockimage">
                    <image src="stocks/placeholder.png" width="200" height="200">
                </div>
                <div class="stockinfo">
                    <div class="stockname">
                        No results found
                    </div>
                    <div class="stockprice">
                        $0.00
                    </div>
                    <div class="stockowner">
                        @
                    </div>
                </div>
            </div>
        ';
    }

    $div .= '
        </div>
    ';

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
            Results:
        </div>
        <?php echo $div; ?>
    </div>
    <?php include_once("footer.php"); ?>
    
</body>
</html>