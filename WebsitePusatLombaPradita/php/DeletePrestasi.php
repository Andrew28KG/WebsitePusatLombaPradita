<?php
include '../inc/db_connect.php';
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$ID_Prestasi = $_GET['ID_Prestasi'];
$query = "DELETE FROM Prestasi WHERE ID_Prestasi = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$ID_Prestasi]);

echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; padding: 40px; background-color: #f0f0f0; border: 3px solid #ccc; border-radius: 10px; text-align: center; z-index: 9999;'> Prestasi tersebut berhasil didelete!</div>";
echo "<meta http-equiv=refresh content=2;URL='/admin/EditDataP.php'>";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Prestasi Page</title>
  <link rel='stylesheet' href='/css/styleD.css'> 
  <style>
      .del {
    display: inline-block;
    padding: 5px 10px;
    text-decoration: none;
    color: #fff;
    border-radius: 5px;
    }
      .del {
          background-color: #f44336;
      }

      .del:hover {
          background-color: #da190b;
      }
    </style>
</head>
<body>
<?php include '../inc/headeradmin.php'; ?>
    <div class="wrappert">
        <div class="post">
        <?php
        // Database connection
        $host = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $database = "websitepusatlombapradita"; 

        $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, $username, $password, $opt);
        $query = "SELECT * FROM Prestasi";
        $stmt = $pdo->query($query);
        ?>
        <!-- Lomba table -->
        <h2>Daftar Prestasi</h2>
        <form id="viewForm">
        <select name="viewSelection" onchange="window.location = this.value;">
              <option value="EditDataP.php">Edit Prestasi</option>
              <option value="EditData.php">Edit Lomba</option>
              <option value="ApproveLomba.php">Approve Lomba</option>
          </select>
        </form>
        <div id="prestasiTable" class="table-responsive">
            <table class="table">
                <!-- Table headers -->
                <tr>
                    <th>ID_Prestasi</th>
                    <th>Waktu_Perolehan</th>
                    <th>Prestasi</th>
                    <th>Tingkat</th>
                    <th>NI</th>
                    <th>Sertifikat</th>
                    <th>Delete</th>
                </tr>

                <!-- Table data -->
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['ID_Prestasi'] ?></td>
                        <td><?= $row['Waktu_Perolehan'] ?></td>
                        <td><?= $row['Prestasi'] ?></td>
                        <td><?= $row['Tingkat'] ?></td>
                        <td><?= $row['NI'] ?></td>
                        <td><img src="../php/imagickPrestasi.php?ID_Prestasi=<?php echo $row['ID_Prestasi']; ?>"></td>
                        <td><a class="del" href="/php/DeletePrestasi.php?ID_Prestasi=<?= $row['ID_Prestasi'] ?>">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>

<?php include '../inc/footeradmin.php'; ?>
</body>
</html>
