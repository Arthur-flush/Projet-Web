<?php
session_start();
ini_set("display_errors", "on");
$conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
}

if (!isset($_SESSION['user'])) {
    echo "You are not logged in";
    header('Location: login.php?error=1');
}

if (!isset($_POST['stockid'])) {
    echo "No stock id";
    header('Location: index.php');
}

if (!isset($_POST['rating'])) {
    echo    "No rating";
    header('Location: stock.php?id=' . $_POST['stockid']);
}

// check if user already posted a review for this item
$id = $_SESSION['user'];
$stockid = $_POST['stockid'];
$sql = "SELECT * FROM rating WHERE user_id = '$id' AND stock_id = '$stockid'";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
else {
    if ($result->num_rows > 0) {
        echo    "You already posted a review for this item";
        header('Location: stock.php?id=' . $_POST['stockid']);
    }
}

// add review
$rating = $_POST['rating'];
$sql = "INSERT INTO rating (user_id, stock_id, rating) VALUES ('$id', '$stockid', '$rating')";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "Review added";
header('Location: stock.php?id=' . $_POST['stockid']);