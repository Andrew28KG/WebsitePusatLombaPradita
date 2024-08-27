<!DOCTYPE html>
<html>
<head>
  <title>Approve Lomba Page</title>
  <link rel='stylesheet' href='/css/styleV.css'> 
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
        include '../inc/db_connect.php';
        $query = "SELECT * FROM Lomba WHERE Status = 0";
        $stmt = $pdo->query($query);
        ?>
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
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php include '../inc/footeradmin.php'; ?>
</body>
</html>
