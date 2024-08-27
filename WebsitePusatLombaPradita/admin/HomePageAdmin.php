<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Home Admin Page</title>
  <link rel='stylesheet' href='/css/styleD.css'> 
</head>
<body>

<?php include '../inc/headeradmin.php'; ?> 
    <div class="wrapper">
    <div class="post">
    <h2>Lomba yang belum diapprove</h2>
<?php
include '../inc/db_connect.php';
$sql = "SELECT * FROM lomba WHERE Status = 0";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll();

if ($stmt->rowCount() > 0) {
    echo "<div class='table-responsive'>";
    echo "<table>";
    echo "<tr><th>ID_Lomba</th><th>Nama Kegiatan</th><th>Status</th><th>Deadline Pendaftaran</th></tr>";

    foreach($result as $row) {
        echo "<tr><td>" . $row["ID_Lomba"] . "</td><td>" . $row["Nama_kegiatan"] . "</td><td>" . $row["Status"] . "</td><td>" . $row["Deadline_Pendaftaran"] . "</td></tr>";
    }

    echo "</table>";
    echo "</div>";
} else {
    echo "Belum ada lomba untuk diapprove";
}
?>
<a href="ApproveLomba.php" class="button">View</a>
    </div>
</div>
    <a href="ViewDataLomba.php" class="kegiatan">
      <div class="button">
          <div>View Data</div>
        </div>
      </a>

    <a href="EditData.php" class="kegiatan">
        <div class="button">
          <div>Edit Data</div>
        </div>
      </a> 

<?php include '../inc/footeradmin.php'; ?>
</body>
</html>
