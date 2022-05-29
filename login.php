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
    <?php include_once("header.php"); ?>
    <div class="content">
        <div class="login">
            <form action="login.php" method="post" class="loginform">
                <input type="text" id="email" name="email" placeholder="email" class="loginemail">
                <input type="password" id="password" name="password" placeholder="password" class="loginpassword">
                <button type="submit" name="login" class="loginbutton">Login</button>
            </form>
            <div class="registerlink">
                Dont have an account ? <a href="register.php">Register</a>
            </div>
        </div>
    </div>

    <?php include_once("footer.php"); ?>
</body>
