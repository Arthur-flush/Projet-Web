<?php 
    
    $isloggedin = false;
    if (isset($_SESSION['user'])) {
        $isloggedin = true;
    }

    if (isset($_POST["search"]) and !isset($_POST["nameordesc"])) {
        if (isset($_POST["namecontains"]))
            $namecontains = $_POST["namecontains"];
        else
            $namecontains = "";
        
        if (isset($_POST["descriptioncontains"]))
            $descriptioncontains = $_POST["descriptioncontains"];
        else
            $descriptioncontains = "";

        if (isset($_POST["pricemin"]))
            $pricemin = $_POST["pricemin"];
        else
            $pricemin = "";
        
        if (isset($_POST["pricemax"]))
            $pricemax = $_POST["pricemax"];
        else
            $pricemax = "";
        
        if (isset($_POST["owner"]))
            $ownername = $_POST["owner"];
        else
            $ownername = "";
        
        if (isset($_POST["createdafter"]))
            $createdafter = $_POST["createdafter"];
        else
            $createdafter = "";
        
        if (isset($_POST["createdbefore"]))
            $createdbefore = $_POST["createdbefore"];
        else
            $createdbefore = "";
        
        if (isset($_POST["ratingmin"]))
            $ratingmin = $_POST["ratingmin"];
        else
            $ratingmin = "";
        
        if (isset($_POST["ratingmax"]))
            $ratingmax = $_POST["ratingmax"];
        else
            $ratingmax = "";

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
    }
    else {
        $namecontains = "";
        $descriptioncontains = "";
        $pricemin = "";
        $pricemax = "";
        $ownername = "";
        $createdafter = "";
        $createdbefore = "";
        $ratingmin = "";
        $ratingmax = "";
        $tagcontains = "";
    }
    
?>

<header>
    <div class="header-top">
        <a href="index.php" class="logo"><image src="images/logo.png" alt="logo" class="logo" /></a>
        <div class="searchdiv">
            <form action="search.php" method="post">
                <input class="searchbar" type="text" id="nameordesc" name="nameordesc" placeholder="Search">
                <button class="searchbutton" type="submit" name="search" id="search">Search</button>
            </form>
        </div>
        <a href="create_stock.php" class="headera"><button class="headerbutton" >Create</button></a>
        <?php 
            $logindiv = '
            <a href="login.php" class="headera" style="border-right: 0px; border-left: 0px"><button class="headerbutton" >Login</button></a>
            <a href="register.php" class="headera"><button class="headerbutton" >Register</button></a>
            ';
            if ($isloggedin) {
                $logindiv = '
                <a href="cart.php" class="headera" style="border-right: 0px; border-left: 0px">
                    <img class="headercart" src="images/cart-regular-48.png"/>
                </a>
                <a href="logout.php" class="headera"><button class="headerbutton" >Logout</button></a>
                ';
            }
            echo $logindiv;
        ?>
        <?php 
        if ($isloggedin) {
            // get image of user from db
            $conn = new mysqli("127.0.0.1", "ProjetWeb", "Password", "ProjetWeb");
            if(! $conn ) {
                die('Could not connect to db');
            }

            $sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_image = $row['profile_pic'];
            }
            $conn->close();

            if ($user_image == "default") {
                $user_image = "default64.png";
            }

            $profilepicdiv = '
            <a href="profile.php?id=' . $_SESSION['user'] . '" class="profilepic">
            <img src="Profile_Pics/' . $user_image . '" class="profilepic" width="48" height="48">
            </a>
            ';
        }
        else
            $profilepicdiv = '
            <a href="login.php" class="profilepic">
                <img src="Profile_Pics/default64.png" class="profilepic" width="48" height="48">
            </a>
            ';
        echo $profilepicdiv;
        ?>
    </div>
    <div class="advancedsearch" id="advancedsearch">
        <div class="advancedsearchtitle">
            Advanced Search:
        </div>
        <form action="search.php" method="post" class="advancedsearchform">
            <input name="namecontains" type="text" placeholder="Name contains" value="<?php echo $namecontains ?>">
            <input name="descriptioncontains" type="text" placeholder="Description contains" value="<?php echo $descriptioncontains ?>">
            <div class="pricerange">
                <input name="pricemin" type="number" placeholder="Price min" min="0" value="<?php echo $pricemin ?>"> - 
                <input name="pricemax" type="number" placeholder="Price max" min="0" value="<?php echo $pricemax ?>">
            </div>
            <div class="advancedsearchformhandle">
                @<input name="owner" type="text" placeholder="Owner" value="<?php echo $ownername ?>">
            </div>
            <div class="pricerange">
                <input name="createdafter" type="date" placeholder="Created after" value="<?php echo $createdafter ?>"> - 
                <input name="createdbefore" type="date" placeholder="Created before" value="<?php echo $createdbefore ?>">
            </div>
            <div class="pricerange">
                <input name="ratingmin" type="number" placeholder="Rating min" min="1" max="5" value="<?php echo $ratingmin ?>"> - 
                <input name="ratingmax" type="number" placeholder="Rating max" min="1" max="5" value="<?php echo $ratingmax ?>">
            </div>
            <!-- tags -->


            <div class="tags">
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advperson" value="person"/>
                    <label for="advperson">person</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advbleu" value="bleu"/>
                    <label for="advbleu">bleu</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advcosplay" value="cosplay"/>
                    <label for="advcosplay">cosplay</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advneutral expression" value="neutral expression"/>
                    <label for="advneutral expression">neutral expression</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advdog" value="dog"/>
                    <label for="advdog">dog</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advkillian" value="killian"/>
                    <label for="advkillian">killian</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advgroup" value="group"/>
                    <label for="advgroup">group</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advarthur" value="arthur"/>
                    <label for="advarthur">arthur</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advchad" value="chad"/>
                    <label for="advchad">chad</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advluca" value="luca"/>
                    <label for="advluca">luca</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advclasse" value="classe"/>
                    <label for="advclasse">classe</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advnature" value="nature"/>
                    <label for="advnature">nature</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advsamy" value="samy"/>
                    <label for="advsamy">samy</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advflex" value="flex"/>
                    <label for="advflex">flex</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advshawn" value="shawn"/>
                    <label for="advshawn">shawn</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advselfie" value="selfie"/>
                    <label for="advselfie">selfie</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advsuit" value="suit"/>
                    <label for="advsuit">suit</label>
                    
                </div>
                <div class="tag">
                    <input type="checkbox" name="tag[]" id="advserious" value="serious"/>
                    <label for="advserious">serious</label>
                    
                </div>
            </div>

            <script>
                <?php 
                    $jsarray = json_encode($tagcontains);
                    echo "var tagarray = ". $jsarray . ";\n";
                ?>
                // tagarray is an array of id of tags as strings

                var tagcheckboxes = document.getElementsByName("tag[]");
                for (var i = 0; i < tagcheckboxes.length; i++) {
                    var tagcheckbox = tagcheckboxes[i];
                    var tagid = tagcheckbox.id;
                    //console.log(tagid);
                    if (tagarray.indexOf(tagid) != -1) {
                        tagcheckbox.checked = true;
                    }
                }



            </script>

            <button class="advancedsearchsubmit" type="submit" name="search" id="search">Advanced Search</button>
        </form>
    </div>
    <script>
        // toggle advanced search function
        function toggleAdvancedSearch() {
            var x = document.getElementById("advancedsearch");
            if (x.style.height === "0px" || x.style.height === "") {
                x.style.height = "520px";
            } else {
                x.style.height = "0px";
            }
        }
    </script>
    <button id="advancedsearchbutton" class="advancedsearchbutton" onclick="toggleAdvancedSearch()">
        Advanced Search
    </button>
</header>