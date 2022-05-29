<?php
session_start();
ini_set("display_errors", "on");

$conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
    echo "hahahah db goes brrrrr";
}
// get all elements in cart and download them

if (!isset($_SESSION['user'])) {
    echo "You are not logged in";
    //header('Location: login.php?error=1');
}

$id = $_SESSION['user'];
$sql = "SELECT * FROM cart_element WHERE user_id = '$id'";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// get stock for each item in cart
$cart = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $stockid = $row['stock_id'];
        $sql = "SELECT * FROM stock WHERE id = '$stockid'";
        $result2 = $conn->query($sql);
        if (!$result2) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $cart[] = $row2;
            }
        }
    }
}

$filebasepath = "stocks/";

// download each image
$zip = new ZipArchive();
$zip_name = "cart_" . uniqid() . ".zip";
$zip_path = "downloads/" . $zip_name;
// echo $cart

$cartimages = array();
foreach ($cart as $item) {
    $filename = $item['image'];
    $filepath = $filebasepath . $filename;
    $cartimages[] = $filepath;
}

touch($zip_path);

if ($zip->open($zip_path, ZipArchive::CREATE) === TRUE) {
    foreach ($cartimages as $image) {
        $filepath = $image;
        echo $filepath . "<br>";
        $zip->addFile($filepath, $image);
    }
    if ($zip->close() === TRUE) {
        echo "The zip archive $zip_path has been created successfully.";
    } else {
        echo "There was an error creating the zip archive.";
    }
}
else {
    echo 'failed';
    
}

function download($filepath)  {
    ob_clean();
    ob_end_flush();

    header("Cache-Control: no-cache, must-revalidate");
    header('Content-Type: application/zip;\n');
    header("Content-Transfer-Encoding: Binary");
    header("Content-Disposition: attachment; filename=\"".basename($filepath)."\"");
    readfile($filepath);
    unlink($filepath);
}

download($zip_path);
