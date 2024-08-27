<!DOCTYPE html>
<html>
<head>
  <title>View Data Lomba Page</title>
  <link rel='stylesheet' href='/css/styleV.css'> 
</head>
<body>
<?php include '../inc/headeradmin.php'; ?>
    <div class="wrappert">
        <div class="post">
        <?php
        include '../inc/db_connect.php';
        $query = "SELECT * FROM Lomba WHERE Status = 1";
        $stmt = $pdo->query($query);
        ?>
        <h2>Daftar Lomba</h2>
        <form id="viewForm">
          <select name="viewSelection" onchange="window.location = this.value;">
              <option value="ViewDataLomba.php">Lomba</option>
              <option value="ViewDataPrestasi.php">Prestasi</option>
          </select>
      </form>
        <div id="lombaTable" class="table-responsive">
            <table class="table">
                <tr>
                    <th>ID Lomba</th>
                    <th>Nama Kegiatan</th>
                    <th>NI</th>
                    <th>Tema</th>
                    <th>Waktu</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Penyelengaraan</th>
                    <th>Deadline Pendaftaran</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                    <th>Syarat</th>
                    <th>Poster</th>
                    <th>Link</th>
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
                        <td><?= $row['Status'] ?></td>
                        <td><?= $row['Lokasi'] ?></td>
                        <td><?= $row['Syarat'] ?></td>
                        <td><img src="../php/imagickLomba.php?ID_Lomba=<?php echo $row['ID_Lomba']; ?>"></td>
                        <td><a href="<?= $row['Link'] ?>" target="_blank" rel="noopener noreferrer" class="button daftar-button">Link Daftar</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

    </div>
</div>

<?php include '../inc/footeradmin.php'; ?>
</body>
</html>
