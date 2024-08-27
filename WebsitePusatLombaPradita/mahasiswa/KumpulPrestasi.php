<?php
session_start();

include '../inc/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['form_data'] = $_POST;
    $NI = $_POST['NI'];
    $Waktu_Perolehan = $_POST['Waktu_Perolehan'];
    $Prestasi = $_POST['Prestasi'];
    $Tingkat = $_POST['Tingkat'];

    $file = $_FILES["Sertifikat"];
    $fileType = $file['type'];
    $fileSize = $file['size'];

    if ($fileSize > 409600) {
        echo("<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; padding: 40px; background-color: #f0f0f0; border: 3px solid #ccc; border-radius: 10px; text-align: center; z-index: 9999;'> Error: File size must be less than 400KB. </div>");
        header("refresh:3;url=KumpulPrestasi.php");
        exit;
    }

    // Check file type
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!in_array($fileType, $allowedTypes)) {
        echo("<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; padding: 40px; background-color: #f0f0f0; border: 3px solid #ccc; border-radius: 10px; text-align: center; z-index: 9999;'> Error: Only JPEG, JPG and PNG files are allowed. </div>");
        header("refresh:3;url=KumpulPrestasi.php");
        exit;
    }

    $SertifikatData = addslashes(file_get_contents($file["tmp_name"]));

    $sql = "INSERT INTO prestasi (NI, Waktu_Perolehan, Prestasi, Tingkat, Sertifikat) 
    VALUES ('$NI', '$Waktu_Perolehan', '$Prestasi', '$Tingkat', '$SertifikatData')";
    $result = $pdo->query($sql);

    unset($_SESSION['form_data']);

    echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; padding: 40px; background-color: #f0f0f0; border: 3px solid #ccc; border-radius: 10px; text-align: center; z-index: 9999;'> Prestasi berhasil disubmit!</div>";
    echo "<meta http-equiv=refresh content=3;URL='/mahasiswa/HomePageMhs.php'>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Submit Prestasi Page</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php include '../inc/headermahasiswa.php'; ?>
<div class="wrapper">
        <div class="leftcontent">
            <div class="post">
                <h2>Upload Prestasi</h2>
                <form action="/mahasiswa/KumpulPrestasi.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="NI">Nomor Indeks Anda:</label>
                    <input type="text" id="NI" name="NI" value="<?php echo isset($_SESSION['NI']) ? $_SESSION['NI'] : ''; ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="Tingkat">Tingkat:</label>
                        <select id="Tingkat" name="Tingkat" required>
                            <?php
                                $options = ["Lokal", "Nasional", "International"];
                                foreach ($options as $option) {
                                $selected = isset($_SESSION['form_data']['Tingkat']) && $_SESSION['form_data']['Tingkat'] == $option ? 'selected' : '';
                                echo "<option value=\"$option\" $selected>$option</option>";
                                }
                            ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Prestasi">Prestasi:</label>
                    <input type="text" id="Prestasi" name="Prestasi" value="<?php echo isset($_SESSION['form_data']['Prestasi']) ? $_SESSION['form_data']['Prestasi'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Waktu_Perolehan">Waktu_perolehan:</label>
                    <input type="date" id="Waktu_Perolehan" name="Waktu_Perolehan" value="<?php echo isset($_SESSION['form_data']['Waktu_Perolehan']) ? $_SESSION['form_data']['Waktu_Perolehan'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Sertifikat">Sertifikat:</label>
                    <input type="file" id="Sertifikat" name="Sertifikat" accept=".jpg, .jpeg, .png" required>
                </div>
                <button type="submit">Submit</button>
            </form>
            </div>
        </div>
        </div>
        <?php include '../inc/footermahasiswa.php'; ?>
    </body>
</html>