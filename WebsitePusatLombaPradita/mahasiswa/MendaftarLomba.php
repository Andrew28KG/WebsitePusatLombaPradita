<!DOCTYPE html>
<html>
<head>
    <title>Daftar Lomba Page</title>
    <link rel='stylesheet' href='/css/styleE.css'>
</head>
<body>
<?php include '../inc/headermahasiswa.php'; ?>
    <div class="wrapperl">
            <div class="post">
            <?php
              $prodiFilter = isset($_GET['Prodi']) ? $_GET['Prodi'] : null;
           ?>
              <div class="filter-container">
                <div class="filter-box">
                  <label for="filterProdi">Filter by Prodi:</label>
                  <select id="filterProdi" name="filterProdi" onchange="location = this.value;">
                      <option value="MendaftarLomba.php"<?php echo $prodiFilter ? '' : ' selected'; ?>>All</option>
                      <?php
                          include '../inc/db_connect.php';
                          $query = "SELECT DISTINCT Prodi FROM Lomba";
                          $stmt = $pdo->query($query);
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                              $selected = $prodiFilter === $row['Prodi'] ? ' selected' : '';
                              echo '<option value="MendaftarLomba.php?Prodi=' . urlencode($row['Prodi']) . '"' . $selected . '>' . $row['Prodi'] . '</option>';
                          }
                          ?>
                          </select>
                          </div>
                          <?php
                          $query = "SELECT COUNT(*) AS jumlah_lomba FROM Lomba WHERE Status = 1 AND Deadline_Pendaftaran > NOW()";
                          if ($prodiFilter) {
                            $query .= " AND (Prodi = :prodi)";
                          }
          
                          $stmt = $pdo->prepare($query);
                          if ($prodiFilter) {
                              $stmt->bindParam(':prodi', $prodiFilter);
                          }
                          $stmt->execute();
          
                          $row = $stmt->fetch(PDO::FETCH_ASSOC);
                          $jumlahLomba = $row['jumlah_lomba'];
                          echo '<h2 class="jumlah-lomba">Jumlah Lomba: ' . $jumlahLomba . '</h2>';
                        ?>
                </div>
              <?php
                $query = "SELECT * FROM Lomba WHERE Status = 1 AND Deadline_Pendaftaran > NOW()";
                if ($prodiFilter) {
                    $query .= " AND (Prodi = :prodi)";
                }

                $stmt = $pdo->prepare($query);
                if ($prodiFilter) {
                    $stmt->bindParam(':prodi', $prodiFilter);
                }
                $stmt->execute();

                echo '<h2 style="text-align: center;">Daftar Lomba</h2>';

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '<a href="DetailLomba.php?ID_Lomba=' . $row['ID_Lomba'] . '">';
                  echo '<div class="lomba">';
                  echo '<div class="lomba-info">';
                  echo '<h3>' . $row['Nama_kegiatan'] . '</h3>';
                    echo '<p><strong>Tema:</strong> ' . $row['Tema'] . '</p>';
                    echo '<p><strong>Batas Pendaftaran:</strong> ' . $row['Deadline_Pendaftaran'] . '</p>';
                    echo '<p><strong>Prodi:</strong> ' . $row['Prodi'] . '</p>';
                  echo '</div>';
                  echo '<img src="../php/imagickDafLom.php?ID_Lomba=' . $row['ID_Lomba'] . '">';
                  echo '</div>';
                  echo '</a>';
                }
                ?>
            </div>
        </div>
        <?php include '../inc/footermahasiswa.php'; ?>
</body>
</html>