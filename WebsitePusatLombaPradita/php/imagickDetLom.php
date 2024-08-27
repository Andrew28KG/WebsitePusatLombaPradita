<?php
include '../inc/db_connect.php';

if (!isset($_GET['ID_Lomba'])) {
    die('ID_Lomba parameter is missing');
}

$ID_Lomba = $_GET['ID_Lomba'];

$sql = "SELECT Poster FROM lomba WHERE ID_Lomba = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $ID_Lomba);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die('No rows returned from query');
}

$imageData = $row['Poster'];

$imagick = new Imagick();
$imagick->readImageBlob($imageData);
$imagick->setIteratorIndex(0);

$imagick->resizeImage(900, 1100, Imagick::FILTER_LANCZOS, 1);
// Output the image
header('Content-Type: image/jpeg');
echo $imagick;
?>