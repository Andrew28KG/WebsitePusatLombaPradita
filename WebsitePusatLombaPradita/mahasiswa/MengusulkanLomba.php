<?php
session_start();
include '../inc/db_connect.php';

ob_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['form_data'] = $_POST;
    $Waktu = $_POST['Waktu'];
    $Tanggal_Pendaftaran = $_POST['Tanggal_Pendaftaran'];
    $Penyelengaraan = $_POST['Penyelengaraan'];
    $Tema = $_POST['Tema'];
    $Deadline_Pendaftaran = $_POST['Deadline_Pendaftaran'];
    $Lokasi = $_POST['Lokasi'];
    $Syarat = $_POST['Syarat'];
    $NI = $_POST['NI'];
    $Nama_kegiatan = $_POST['Nama_kegiatan'];
    $file = $_FILES["Poster"];
    $fileType = $file['type'];
    $fileSize = $file['size'];

    // Check file size (400KB = 409600 bytes)
    if ($fileSize > 409600) {
        echo("<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; padding: 40px; background-color: #f0f0f0; border: 3px solid #ccc; border-radius: 10px; text-align: center; z-index: 9999;'> Error: File size must be less than 400KB. </div>");
        header("refresh:3;url=MengusulkanLomba.php");
        exit;
    }

    // Check file type
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!in_array($fileType, $allowedTypes)) {
        echo("<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; padding: 40px; background-color: #f0f0f0; border: 3px solid #ccc; border-radius: 10px; text-align: center; z-index: 9999;'> Error: Only JPEG, JPG and PNG files are allowed. </div>");
        header("refresh:3;url=MengusulkanLomba.php");
        exit;
    }

    $PosterData = addslashes(file_get_contents($file["tmp_name"]));
    $Link = $_POST['Link'];
    $Prodi = $_POST['Prodi'];

    $sql = "INSERT INTO lomba (Waktu, Tanggal_Pendaftaran, Penyelengaraan, Tema, Deadline_Pendaftaran, Lokasi, Nama_kegiatan, Poster, NI, Link, Syarat, Prodi) 
    VALUES ('$Waktu', '$Tanggal_Pendaftaran', '$Penyelengaraan', '$Tema', '$Deadline_Pendaftaran', '$Lokasi', '$Nama_kegiatan', '$PosterData', '$NI', '$Link', '$Syarat', '$Prodi')";
    $result = $pdo->query($sql);

    unset($_SESSION['form_data']);

    echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; padding: 40px; background-color: #f0f0f0; border: 3px solid #ccc; border-radius: 10px; text-align: center; z-index: 9999;'> Usulan Lomba berhasil disubmit!</div>";
    echo "<meta http-equiv=refresh content=3;URL='/mahasiswa/HomePageMhs.php'>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Mengusulkan Lomba Page</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>
<?php include '../inc/headermahasiswa.php'; ?>
    <div class="wrapper">
    <div class="leftcontent">
        <div class="post" style="max-height: 600px; overflow-y: auto;">
            <h2>Berikan info mengenai lomba yang ingin disusul</h2>
            <form action="/mahasiswa/MengusulkanLomba.php" method="POST" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="NI">Nomor Indeks Anda:</label>
                        <input type="text" id="NI" name="NI" value="<?php echo isset($_SESSION['NI']) ? $_SESSION['NI'] : ''; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="Nama_kegiatan">Nama kegiatan:</label>
                        <input type="text" id="Nama_kegiatan" name="Nama_kegiatan" value="<?php echo isset($_SESSION['form_data']['Nama_kegiatan']) ? $_SESSION['form_data']['Nama_kegiatan'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                    <label for="Link">Link Pendaftaran:</label>
                    <input type="text" id="Link" name="Link" value="<?php echo isset($_SESSION['form_data']['Link']) ? $_SESSION['form_data']['Link'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Prodi">Prodi:</label>
                            <select id="Prodi" name="Prodi" required>
                                <?php
                                    $options = ["ARCHITECTURE", "URBAN PLANNING", "CIVIL ENGINEERING", "INTERIOR DESIGN", "VISUAL COMMUNICATION DESIGN", "ACCOUNTING", "F&B RETAIL MANAGEMENT", "BUSINESS MANAGEMENT", "INFORMATION TECHNOLOGY", "BUSINESS INFORMATION SYSTEM", "HOSPITALITY & TOURISM", "CULINARY ART", "SEMUA"];
                                    foreach ($options as $option) {
                                        $selected = isset($_SESSION['form_data']['Prodi']) && $_SESSION['form_data']['Prodi'] == $option ? 'selected' : '';
                                        echo "<option value=\"$option\" $selected>$option</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Waktu">Waktu:</label>
                        <input type="time" id="Waktu" name="Waktu" value="<?php echo isset($_SESSION['form_data']['Waktu']) ? $_SESSION['form_data']['Waktu'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Tanggal_Pendaftaran">Tanggal Pendaftaran:</label>
                        <input type="date" id="Tanggal_Pendaftaran" name="Tanggal_Pendaftaran" value="<?php echo isset($_SESSION['form_data']['Tanggal_Pendaftaran']) ? $_SESSION['form_data']['Tanggal_Pendaftaran'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Penyelengaraan">Penyelengaraan:</label>
                        <input type="date" id="Penyelengaraan" name="Penyelengaraan" value="<?php echo isset($_SESSION['form_data']['Penyelengaraan']) ? $_SESSION['form_data']['Penyelengaraan'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Deadline_Pendaftaran">Deadline Pendaftaran:</label>
                        <input type="date" id="Deadline_Pendaftaran" name="Deadline_Pendaftaran" value="<?php echo isset($_SESSION['form_data']['Deadline_Pendaftaran']) ? $_SESSION['form_data']['Deadline_Pendaftaran'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Tema">Tema:</label>
                        <input type="text" id="Tema" name="Tema" value="<?php echo isset($_SESSION['form_data']['Tema']) ? $_SESSION['form_data']['Tema'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Lokasi">Lokasi:</label>
                        <input type="text" id="Lokasi" name="Lokasi" value="<?php echo isset($_SESSION['form_data']['Lokasi']) ? $_SESSION['form_data']['Lokasi'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Syarat">Syarat:</label>
                        <input type="text" id="Syarat" name="Syarat" value="<?php echo isset($_SESSION['form_data']['Syarat']) ? $_SESSION['form_data']['Syarat'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Poster">Poster:</label>
                        <input type="file" id="Poster" name="Poster" class="file-input" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
        </div>
        <?php include '../inc/footermahasiswa.php'; ?>
    </body>
</html>