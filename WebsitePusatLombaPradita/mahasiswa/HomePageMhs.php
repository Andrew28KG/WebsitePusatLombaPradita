<?php
session_start();

include '../inc/db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home Mahasiswa Page</title>
  <link rel='stylesheet' href='/css/style.css'> 
</head>
<body>
  <?php include '../inc/headermahasiswa.php'; ?>
    <div class="slider-frame">
            <div class="slide-images">
                    <div class="img-container">
                        <img src="/images/lomba1.png">
                    </div>
                    <div class="img-container">
                        <img src="/images/lomba2.png">
                    </div>
                    <div class="img-container">
                        <img src="/images/lomba3.png">
                    </div>
            </div>
    </div>
    
    <a href="MendaftarLomba.php" class="kegiatan">
        <div class="button">
          <img src="/images/college entrance exam-amico.svg" alt="Daftar Lomba">
          <div>DAFTAR LOMBA</div>
        </div>
      </a>

    <a href="KumpulPrestasi.php" class="kegiatan">
        <div class="button">
          <img src="/images/Success factors-amico.svg" alt="Submit Prestasi">
          <div>KIRIM PRESTASI</div>
        </div>
      </a> 

    <a href="MengusulkanLomba.php" class="kegiatan">
        <div class="button">
          <img src="/images/team checklist-amico.svg" alt="Membuat Lomba">
          <div>MENGUSULKAN LOMBA</div>
        </div>
      </a>

    <?php include '../inc/footermahasiswa.php'; ?>
</body>
</html>
