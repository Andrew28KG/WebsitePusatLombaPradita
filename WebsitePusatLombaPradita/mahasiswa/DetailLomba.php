<!DOCTYPE html>
<html>
<head>
    <title>Detail Lomba Page</title>
    <link rel='stylesheet' href='/css/styleC.css'>
</head>
<body>
    <?php include '../inc/headermahasiswa.php'; ?>
    <?php
        include '../inc/db_connect.php';

        if (!isset($_GET['ID_Lomba'])) {
            die("No ID_Lomba provided");
        }

        $lombaId = $_GET['ID_Lomba'];

        $query = "SELECT * FROM Lomba WHERE ID_Lomba = :ID_Lomba";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':ID_Lomba', $lombaId);
        $stmt->execute();

        $lomba = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="wrapperl">
        <div class="post">
            <a href="/mahasiswa/MendaftarLomba.php" class="back-button">Back</a>
            <div class="info-container">
                <img src="../php/imagickDetLom.php?ID_Lomba=<?php echo $lomba['ID_Lomba']; ?>" class="lomba-image">
                <div class="info-box">
                    <h2><?php echo $lomba['Nama_kegiatan']; ?></h2>
                    <p>Waktu: <?php echo $lomba['Waktu']; ?></p>
                    <p>Deadline Pendaftaran: <?php echo $lomba['Deadline_Pendaftaran']; ?></p>
                    <p>Penyelengaraan: <?php echo $lomba['Penyelengaraan']; ?></p>
                    <p>Tema: <?php echo $lomba['Tema']; ?></p>
                    <p>Lokasi: <?php echo $lomba['Lokasi']; ?></p>
                    <p>Syarat: <?php echo $lomba['Syarat']; ?></p>
                    <a href="<?php echo $lomba['Link']; ?>" class="button daftar-button">Daftar</a>
                </div>
            </div>
        </div>
    </div>
    <?php include '../inc/footermahasiswa.php'; ?>
</body>
</html>
