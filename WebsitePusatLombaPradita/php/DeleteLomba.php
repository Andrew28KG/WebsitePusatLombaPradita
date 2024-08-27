<?php
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

$ID_Lomba = $_GET['ID_Lomba'];
$query = "DELETE FROM Lomba WHERE ID_Lomba = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$ID_Lomba]);

echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; padding: 40px; background-color: #f0f0f0; border: 3px solid #ccc; border-radius: 10px; text-align: center; z-index: 9999;'> Lomba tersebut berhasil didelete!</div>";
echo "<meta http-equiv=refresh content=2;URL='/admin/EditData.php'>";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Lomba Page</title>
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
        $query = "SELECT * FROM Lomba WHERE Status = 1";
        $stmt = $pdo->query($query);
        ?>
        <!-- Lomba table -->
        <h2>Daftar Lomba</h2>
        <form id="viewForm">
          <select name="viewSelection" onchange="window.location = this.value;">
              <option value="EditData.php">Edit Lomba</option>
              <option value="EditDataP.php">Edit Prestasi</option>
              <option value="ApproveLomba.php">Approve Lomba</option>
          </select>
      </form>
        <div id="lombaTable" class="table-responsive">
            <table class="table">
                <tr>
                    <th>ID_Lomba</th>
                    <th>Nama_kegiatan</th>
                    <th>NI</th>
                    <th>Tema</th>
                    <th>Waktu</th>
                    <th>Tanggal_Pendaftaran</th>
                    <th>Penyelengaraan</th>
                    <th>Deadline_Pendaftaran</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                    <th>Syarat</th>
                    <th>Poster</th>
                    <th>Delete</th>
                </tr>

                <!-- Table data -->
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['ID_Lomba'] ?></td>
                        <td><?= $row['Nama_kegiatan'] ?></td>
                        <td><?= $row['NI'] ?></td>
                        <td><?= $row['Tema'] ?></td>
                        <td><?= $row['Waktu'] ?></td>
                        <td><?= $row['Tanggal_Pendaftaran'] ?></td>
                        <td><?= $row['Penyelengaraan'] ?></td>
                        <td><?= $row['Deadline_Pendaftaran'] ?></td>
                        <td><?= $row['Status'] ?></td>
                        <td><?= $row['Lokasi'] ?></td>
                        <td><?= $row['Syarat'] ?></td>
                        <td><img src="../php/imagickLomba.php?ID_Lomba=<?php echo $row['ID_Lomba']; ?>"></td>
                        <td><a class="del" href="/php/DeleteLomba.php?ID_Lomba=<?= $row['ID_Lomba'] ?>">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

    </div>
</div>

<?php include '../inc/footeradmin.php'; ?>
</body>
</html>
