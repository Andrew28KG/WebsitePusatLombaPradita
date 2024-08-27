<!DOCTYPE html>
<html>
<head>
  <title>View Data Prestasi Page</title>
  <link rel='stylesheet' href='/css/styleV.css'> 
</head>
<body>
    <div class="navbar">
      <img src="/images/LogoPradita.png" alt="Logo Pradita">
      <ul class="navbar-right">
        <li><a href="HomePageAdmin.php">Beranda</a></li>
        <li><a href="ViewDataLomba.php">View</a></li>
        <li><a href="EditData.php">Edit</a></li>
      </ul>
    </div>  
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
            <option value="ViewDataLomba.php">Lomba</option>
            <option value="ViewDataPrestasi.php" selected>Prestasi</option>
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
                </tr>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['ID_Prestasi'] ?></td>
                        <td><?= $row['Waktu_Perolehan'] ?></td>
                        <td><?= $row['Prestasi'] ?></td>
                        <td><?= $row['Tingkat'] ?></td>
                        <td><?= $row['NI'] ?></td>
                        <td><img src="../php/imagickPrestasi.php?ID_Prestasi=<?php echo $row['ID_Prestasi']; ?>"></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>

  <footer class="footer">
    <div class="copyright-text">© Pradita University 2018-2023.</div>
    <div class="copyright-text">Made by Kelompok F.A.J.</div>
  </footer>
</body>
</html>
