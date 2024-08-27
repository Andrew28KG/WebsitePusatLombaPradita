<?php
session_start();

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

if (isset($_GET['ID_Lomba'])) {
    $ID_Lomba = $_GET['ID_Lomba'];
    $query = "UPDATE lomba SET Status = '1' WHERE ID_Lomba = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$ID_Lomba]);

    echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; padding: 40px; background-color: #f0f0f0; border: 3px solid #ccc; border-radius: 10px; text-align: center; z-index: 9999;'> Lomba tersebut berhasil diapprove!</div>";
    echo "<meta http-equiv=refresh content=2;URL='/admin/ApproveLomba.php'>";
}

$query = "SELECT * FROM Lomba";
$stmt = $pdo->query($query);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Approve Lomba Page</title>
  <link rel='stylesheet' href='/css/styleD.css'> 
  <style>
      .acc, .del {
    display: inline-block;
    padding: 5px 10px;
    text-decoration: none;
    color: #fff;
    border-radius: 5px;
    }

      .acc {
          background-color: #4CAF50;
      }

      .acc:hover {
          background-color: #45a049;
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
        $query = "SELECT * FROM Lomba WHERE Status = 0";
        $stmt = $pdo->query($query);
        ?>
        <!-- Lomba table -->
        <h2>Approval Lomba</h2>
        <form id="viewForm">
          <select name="viewSelection" onchange="window.location = this.value;">
              <option value="ApproveLomba.php">Approve Lomba</option>
              <option value="EditData.php">Edit Lomba</option>
              <option value="EditDataP.php">Edit Prestasi</option>
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
                    <th>Lokasi</th>
                    <th>Syarat</th>
                    <th>Poster</th>
                    <th>Approve</th>
                    <th>Reject</th>
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
                        <td><?= $row['Lokasi'] ?></td>
                        <td><?= $row['Syarat'] ?></td>
                        <td><img src="../php/imagickLomba.php?ID_Lomba=<?php echo $row['ID_Lomba']; ?>"></td>
                        <td><a class="acc" href="/php/ApproveLomba.php?ID_Lomba=<?= $row['ID_Lomba'] ?>">Approve</a></td>
                        <td><a class="del" href="/php/RejectLomba.php?ID_Lomba=<?= $row['ID_Lomba'] ?>">Reject</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

    </div>
</div>
<?php include '../inc/footeradmin.php'; ?>

</body>
</html>
