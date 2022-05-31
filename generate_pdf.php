<?php
session_start();
ini_set("display_errors", "on");
$conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
}


if (!isset($_GET['id'])) {
    echo "No id";
    die();
    //header('Location: index.php');
}

// get stock info from id
$id = $_GET['id'];
$sql = "SELECT name, description, price, image, owner, stock.created_at, tags, AVG(rating) FROM stock JOIN rating ON rating.stock_id=stock.id WHERE stock.id = '$id'";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $imagename = $row['image'];
        $owner = $row['owner'];
        $created_at = $row['created_at'];
        $tags = explode(",", $row['tags']);
        $ratings = $row['AVG(rating)'];

        // get user info from owner
        $sql = "SELECT * FROM users WHERE id = '$owner'";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $owner_name = $row['handle'];
            }
        }
    }
}

$image = "stocks/" . $imagename;
$watermark_path = "images/watermark.png";

// add watermark to image
$watermark = imagecreatefrompng($watermark_path);
$watermark_width = imagesx($watermark);
$watermark_height = imagesy($watermark);

$im = imagecreatefrompng($image);

$im2 = imagescale($im, $watermark_width, $watermark_height);

imagecopy($im2, $watermark, imagesx($im2) - $watermark_width - 10, imagesy($im2) - $watermark_height - 10, 0, 0, $watermark_width, $watermark_height);

imagepng($im2, "tmp/" . $imagename);
imagedestroy($im);
imagedestroy($im2);



require('fpdf/fpdf.php');

$pdf = new FPDF("P", "mm", "A4");
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 36);
$pdf->Image('images/logo-inverted.png', 10, 10, 30);
$pdf->Cell(80, 10, "", 0, 0);
$pdf->Cell(20, 30, iconv('UTF-8', "windows-1252", $name), 0, 1, 'C');
$pdf->SetFont('Arial', '', 20);
$pdf->image("tmp/" . $imagename, 10, 40, 140);
$pdf->Cell(150, 10, "", 0, 0);
$pdf->Cell(20, 30, "Price: $" . iconv('UTF-8', "windows-1252", $price), 0, 1);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(150, 10, "", 0, 0);
$pdf->Cell(20, 30, "Author: @" . iconv('UTF-8', "windows-1252", $owner_name), 0, 1);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(150, 10, "", 0, 0);
$pdf->Cell(20, 20, "Created at: ", 0, 1);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(145, 10, "", 0, 0);
$pdf->Cell(20, 10, $created_at, 0, 1);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(150, 20, "", 0, 0);
$pdf->Cell(20, 15, "Tags: ", 0, 1);
foreach ($tags as $tag) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(150, 7, "", 0, 0);
    $pdf->Cell(20, 7, "# " . $tag, 0, 1);
}
$pdf->SetFont('Arial', '', 16);

if ($ratings > 0) {
    $pdf->Cell(150, 20, "", 0, 0);
    $pdf->Cell(20, 10, "Rating: ", 0, 1);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(150, 10, "", 0, 0);
    $pdf->Cell(20, 10, number_format(round($ratings, 2), 2), 0, 1);
}
else {
    $pdf->Cell(150, 20, "", 0, 0);
    $pdf->Cell(20, 10, "Rating: ", 0, 1);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(150, 10, "", 0, 0);
    $pdf->Cell(20, 10, "No ratings yet", 0, 1);
}

// description
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(20, 30, "", 0, 0);
$pdf->Cell(20, 20, "Description: ", 0, 1);
$pdf->SetFont('Arial', '', 14);
$pdf->MultiCell(0, 7, iconv('UTF-8', "windows-1252", $description), 0, 1);

$pdf->Output();