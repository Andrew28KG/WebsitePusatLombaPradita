<!DOCTYPE html>
<html>
<head>
  <title>Edit Data Prestasi Page</title>
  <link rel='stylesheet' href='/css/styleV.css'> 
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
        include '../inc/db_connect.php';
        $query = "SELECT * FROM Prestasi";
        $stmt = $pdo->query($query);
        ?>
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
                <tr>
                    <th>ID Prestasi</th>
                    <th>Waktu Perolehan</th>
                    <th>Prestasi</th>
                    <th>Tingkat</th>
                    <th>NI</th>
                    <th>Sertifikat</th>
                    <th>Delete</th>
                </tr>
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
