<?php
include '../inc/db_connect.php';

if (!isset($_GET['ID_Prestasi'])) {
    die('ID_Prestasi parameter is missing');
}

$ID_Prestasi = $_GET['ID_Prestasi'];

$sql = "SELECT Sertifikat FROM prestasi WHERE ID_Prestasi = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $ID_Prestasi);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die('No rows returned from query');
}

$imageData = $row['Sertifikat'];

$imagick = new Imagick();
$imagick->readImageBlob($imageData);
$imagick->setIteratorIndex(0);

$imagick->resizeImage(450, 300, Imagick::FILTER_LANCZOS, 1);
// Output the image
header('Content-Type: image/jpeg');
echo $imagick;
?>