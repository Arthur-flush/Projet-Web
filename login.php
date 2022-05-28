<?php
    session_start();
    ini_set("display_errors", "on");

    if (isset($_GET['error'])) {
        if ($_GET['error'] == 1) {
            echo "You must be logged in to do this action.";
        }
    }

    if (isset($_POST['login'])) {
        $conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
        if(! $conn ) {
            die('Could not connect to db');
            echo "hahahah db goes brrrrr";
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = hash('sha256', $password);

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user'] = $row['id'];
            header('Location: index.php');
        } else {
            echo "Wrong email or password";
        }

        //echo 'Connected successfully';
        $conn->close();
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
    <header>
        <a href="index.php" class="logo"><image src="images/logo.png" alt="logo" class="logo" /></a>
        <div class="searchdiv">
            <form>
                <input class="searchbar" type="text" id="search" name="search" placeholder="Search">
                <button class="searchbutton" type="submit" name="search_button">Search</button>
            </form>
        </div>
        <a href="create_stock.php" class="headera"><button class="headerbutton" >Create</button></a>
        <?php 
            $div = '
            <a href="login.php" class="headera"><button class="headerbutton" >Login</button></a>
            <a href="register.php" class="headera"><button class="headerbutton" >Register</button></a>
            ';
            if ($isloggedin) {
                $div = '
                <a href="logout.php" class="headera"><button class="headerbutton" >Logout</button></a>
                ';
            }
            echo $div;
        ?>
        <img src="Profile_Pics/default64.png" class="profilepic">
    </header>
    <form action="login.php" method="post">
        <input type="text" id="email" name="email" placeholder="email">
        <input type="password" id="password" name="password" placeholder="password">
        <button type="submit" name="login">Login</button>
    </form>
    Dont have an account ?? <a href="register.php">Register</a>
</body>
