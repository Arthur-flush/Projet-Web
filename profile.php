<?php
session_start();
ini_set("display_errors", "on");
$conn = new mysqli("localhost", "ProjetWeb", "Password", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
}

if (isset($_POST['Save'])) {
    // save bio and picture to db
    $id = $_SESSION['user'];
    $bio = htmlspecialchars($_POST['bio'], ENT_QUOTES);
    $img = $_FILES['fileToUpload']['name'];

    if (getimagesize($_FILES['fileToUpload']['tmp_name']) == false) {
        header("Location: profile.php?error=1&id=$id");
    }

    if (file_exists($img)) {
        header("Location: profile.php?error=2&id=$id");
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        header("Location: profile.php?error=3&id=$id");
    }

    $target_dir = "./Profile_Pics/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        header("Location: profile.php?error=4&id=$id");
    }

    if ($img == "" && $bio == "") {
        header("Location: profile.php?error=5&id=$id");
    }

    $sql = "UPDATE users SET ";
    if ($bio != "") {
        $sql .= "bio = '$bio'";
    }
    if ($img != "") {
        $sql .= ", profile_pic = '$img'";
    }
    $sql .= " WHERE id = $id";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: profile.php?id=$id");
    } else {
        print_r($_POST);
        die("Error: " . $conn->error);
        //header("Location: profile.php?error=5&id=$id");
    }

    $conn->close();
}



if (isset($_SESSION['user'])) {
    $userid = $_SESSION['user'];
} else {
    $userid = 0;
}

if (isset($_GET['id'])) {
    $pageid = $_GET['id'];
} else {
    $pageid = $userid;
}

// check if user exists
$sql = "SELECT * FROM users WHERE id = '$pageid'";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
if ($result->num_rows == 0) {
    //header("Location: index.php");
    die("User does not exist");
}

// get user image from db
$sql = "SELECT * FROM users WHERE id = '$pageid'";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$user = $result->fetch_assoc();


if (isset($_GET['error'])) {
    $error = $_GET['error'];
    $id = $_GET['id'];
    $div = "
    <div class='ErrorMsg'>
        <strong>Error:</strong> placeholdertxt
        
    </div>
    ";
    switch ($_GET['error']) {
        case 1:
            $div = str_replace("placeholdertxt", "The file is not an image.", $div);
            break;
        case 2:
            $div = str_replace("placeholdertxt", "Sorry, file already exists.", $div);
            break;
        case 3:
            $div = str_replace("placeholdertxt", "Sorry, your file is too large.", $div);
            break;
        case 4:
            $div = str_replace("placeholdertxt", "Sorry, there was an error uploading your file.", $div);
            break;
        case 5:
            $div = str_replace("placeholdertxt", "Sorry, there was an error while saving.", $div);
            break;
    }
}
else if ($userid == $pageid) { // user page of the current user
    $div = '
        <div class="profile">
            <form action="profile.php?id=' . $pageid . '"
            " class="profiledata" method="post" enctype="multipart/form-data" runat="server">
                <div class="profileimage">
                    <img src="Profile_Pics/placeholder.png" width="300" height="300" id="profileimage">
                </div>
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/png" class="profileimgupload">
                <div class="profileinfo">
                    <div class="profiletitle">
                        Handle:
                    </div>  
                    <div class="profileusername">
                        @placeholderusername
                    </div>
                    <div class="profiletitle">
                        Email:
                    </div>
                    <div class="profileemail">
                        placeholderemail
                    </div>
                    <div class="profiletitle">
                        Bio:
                    </div>
                    <div class="profiletextarea">
                        <textarea name="bio" class="profilebioinput" placeholder="Bio" rows="5" cols="70">placeholderbio</textarea>
                    </div>
                </div>
                <script>
                    function cancelProfile() {
                        window.location.href = "profile.php?id=placeholderid";
                    }
                </script>
                <div class="profilebuttons">
                    <input type="submit" value="Save"   name="Save" class="profilebuttonsave">
                    <input type="button" value="Cancel" name="Cancel" class="profilebuttoncancel" onclick="cancelProfile()">
                </div>
            </form>
            <div class="deleteuser">
                <form action="profile.php?id=' . $pageid . '" method="post" enctype="multipart/form-data" runat="server">
                    <div class="deleteuserbuttons">
                        <input type="submit" value="Delete User" name="Delete" class="deleteuserbutton">
                    </div>
                </form>
            </div>
        </div>

        <script>
            // source: https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
            fileToUpload.onchange = evt => {
                const [file] = fileToUpload.files;
                if (file) {
                    profileimage.src = URL.createObjectURL(file);
                }
            }
        </script>
        
        
    ';

    $div = str_replace("placeholderusername", $user['handle'], $div);
    $div = str_replace("placeholderemail", $user['email'], $div);
    $div = str_replace("placeholderbio", $user['bio'], $div);
    if ($user['profile_pic'] == "default") {
        $div = str_replace("placeholder.png", "default512.png", $div);
    }
    else {
        $div = str_replace("placeholder.png", $user['profile_pic'], $div);
    }
} 
else { // user page of another user
    $div = "
        <div class='profile'>
            <div class='profiledata'>
                <div class='profileimage'>
                    <img src='Profile_Pics/placeholder.png' width='300' height='300' id='profileimage'>
                </div>
                <div class='profileinfo'>
                    <div class='profiletitle'>
                        Handle:
                    </div>  
                    <div class='profileusername'>
                        @placeholderusername
                    </div>
                    <div class='profiletitle'>
                        Email:
                    </div>
                    <div class='profileemail'>
                        placeholderemail
                    </div>
                    <div class='profiletitle'>
                        Bio:
                    </div>
                    <div class='profilebio'>
                        placeholderbio
                    </div>
                </div>
            </div>
        
    ";

    // check if user is admin
    $sql = "SELECT * FROM users WHERE id = '$userid'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $user = $result->fetch_assoc();
    if ($user['admin'] == 1) {
        $div .= '
        <div class="deleteuser">
            <form action="deleteuser.php" method="post" enctype="multipart/form-data" runat="server">
                <div class="deleteuserbuttons">
                    <input type="hidden" name="id" value="' . $pageid . '">
                    <input type="submit" value="Delete User" name="Delete" class="deleteuserbutton">
                </div>
            </form>
        </div>
            ';
    }

    $div .= "</div>";

    // get page user info
    $sql = "SELECT * FROM users WHERE id = '$pageid'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $user = $result->fetch_assoc();


    $div = str_replace("placeholderusername", $user['handle'], $div);
    $div = str_replace("placeholderemail", $user['email'], $div);
    $div = str_replace("placeholderbio", $user['bio'], $div);
    if ($user['profile_pic'] == "default") {
        $div = str_replace("placeholder.png", "default512.png", $div);
    }
    else {
        $div = str_replace("placeholder.png", $user['profile_pic'], $div);
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
    <?php include_once("header.php"); ?>
        <div class="content">
            <?php
            echo $div;
            ?>
        </div>
    <?php include_once("footer.php"); ?>
    </body>

</html>