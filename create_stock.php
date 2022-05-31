<?php
    session_start();
    ini_set("display_errors", "on");
    // check if user is logged in
    if (!isset($_SESSION['user'])) {
        echo "You are not logged in";
        header('Location: login.php');
    }

    // save the file
    $save_dir = "./stocks";
    $filename = uniqid(rand(), true) . ".png";
    $save_file = "$save_dir/$filename";
    $uploadOk = 1;
    // Check if image file is a actual image or fake image
    if (isset($_POST["Create"])) {
        $check = getimagesize($_FILES["stock_IMAGE"]["tmp_name"]);
        if ($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        // shouldnt happen though
        if (file_exists($save_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["stock_IMAGE"]["size"] > 50000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }



        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        }
        else {
            if (move_uploaded_file($_FILES["stock_IMAGE"]["tmp_name"], $save_file)) {
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $created_record = false;
        // save the stock in the db

        $conn = new mysqli("127.0.0.1", "ProjetWeb", "Password", "ProjetWeb");
        if(! $conn ) {
            echo "hahahah db goes brrrrr";
            die('Could not connect to db');
        }
        // get user id from db
        $id = $_SESSION['user'];
        $name = $_POST['stock_NAME'];
        // check if name is valid
        if (!preg_match("/^[a-zA-Z0-9._-]+$/", $name)) {
            echo "Error: The stock name must be alphanumeric";
            die();
        }
        $description = $_POST['stock_DESCRIPTION'];
        $price = $_POST['stock_PRICE'];
        // check if price is a real number
        if (!is_numeric($price)) {
            echo "Error: The stock price must be a number";
            die();
        }

        $tags = $_POST['tag'];
        // make tags into a string
        $tags = implode(",", $tags);


        $sql = "INSERT INTO stock (name, description, image, price, owner, tags) VALUES ('$name', '$description', '$filename', '$price', '$id', '$tags')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            $created_record = true;
            header('Location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        

        if (!$created_record) {
            // delete file
            unlink($save_file);
        }
    }

    $isloggedin = false;
    if (isset($_SESSION['user'])) {
        $isloggedin = true;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>SHOP</title>
    <link rel="stylesheet" href="./Style.css">
</head>
<body>
    <?php include_once("header.php"); ?>
    <form action="create_stock.php" method="post" enctype="multipart/form-data" runat="server" class="creationform">
        <div class="creationtext">
            Name your stock picture:
        </div>

        <input type="text" id="stock_NAME" name="stock_NAME" placeholder="stock name" class="creationinput">
        
        <div class="creationtext">
        Upload your stock picture:
        </div>

        <image id="stock_PREVIEW" src="stocks/placeholder.png"  width="300" height="300" class="creationimage">
        <input type="file" id="stock_IMAGE" name="stock_IMAGE" accept="image/png" class="creationimagebutton">
        
        <div class="creationtext">
        Describe your stock picture:
        </div>

        <textarea id="stock_DESCRIPTION" name="stock_DESCRIPTION" placeholder="stock description" rows="15" class="creationdescription"></textarea>
        
        <div class="creationtext">
        Selling Price:
        </div>

        <input type="text" id="stock_PRICE" name="stock_PRICE" placeholder="Selling Price" class="creationinput">
        <div class="tags">
            <div class="tag">
                <input type="checkbox" name="tag[]" id="person" value="person"/>
                <label for="person">person</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="bleu" value="bleu"/>
                <label for="bleu">bleu</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="cosplay" value="cosplay"/>
                <label for="cosplay">cosplay</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="neutral expression" value="neutral expression"/>
                <label for="neutral expression">neutral expression</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="dog" value="dog"/>
                <label for="dog">dog</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="killian" value="killian"/>
                <label for="killian">killian</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="group" value="group"/>
                <label for="group">group</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="arthur" value="arthur"/>
                <label for="arthur">arthur</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="chad" value="chad"/>
                <label for="chad">chad</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="luca" value="luca"/>
                <label for="luca">luca</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="classe" value="classe"/>
                <label for="classe">classe</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="nature" value="nature"/>
                <label for="nature">nature</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="samy" value="samy"/>
                <label for="samy">samy</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="flex" value="flex"/>
                <label for="flex">flex</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="shawn" value="shawn"/>
                <label for="shawn">shawn</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="selfie" value="selfie"/>
                <label for="selfie">selfie</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="suit" value="suit"/>
                <label for="suit">suit</label>
                
            </div>
            <div class="tag">
                <input type="checkbox" name="tag[]" id="serious" value="serious"/>
                <label for="serious">serious</label>
                
            </div>
        </div>
            


        <button type="submit" name="Create" class="creationbutton">Create</button>
    </form>

    <script>
        // source: https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
        stock_IMAGE.onchange = evt => {
            const [file] = stock_IMAGE.files;
            if (file) {
                stock_PREVIEW.src = URL.createObjectURL(file);
            }
        }
    </script>
    <?php include_once("footer.php"); ?>
</body>
</html>