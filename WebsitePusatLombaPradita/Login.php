<?php
session_start();

$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "websitepusatlombapradita"; 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NI = $_POST["NI"];
    $Password = $_POST["Password"];
    $sql = "SELECT * FROM user WHERE NI='$NI' AND Password='$Password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Status = $row["Status"];

        // Store NI in session
        $_SESSION['NI'] = $NI;

        if ($Status == "Admin") {
            header("Location: /admin/HomePageAdmin.php"); 
            exit();
        }
         else if ($Status == "Mahasiswa") {
            header("Location: /mahasiswa/HomePageMhs.php");
            exit();
        } else {
            echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'><div style='background-color: #ffcccc; padding: 20px; border-radius: 5px; text-align: center;'><h3>Invalid user status.</h3></div></div>";
        }
    } else {
        echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'><div style='background-color: #ffcccc; padding: 20px; border-radius: 5px; text-align: center; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);'><h3>Invalid Nomor indeks atau password.</h3></div></div>";
        echo "<meta http-equiv=refresh content=3;URL='/Login.php'>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel='stylesheet' href='/css/Login.css'>
</head>
<body>
  <div class="container">
    <div class="loginForm">
      <form action="/Login.php" method="post" class="formContent">
        <div class="formHeader">
          <h1>Website Pusat Lomba Pradita</h1>
          <p>Tolong isikan <b>nomor indeks</b> serta <b>kata sandi</b> Anda</p>
        </div>
        <div class="inputForm">
          <div class="input">
            <input type="text" name="NI" placeholder=" " />
            <div class="label">
              <label for="NI">Nomor Indeks</label>
            </div>
          </div>
          <div class="input">
            <input type="password" name="Password" placeholder=" " />
            <div class="label">
              <label for="Password">Kata Sandi</label>
            </div>
          </div>
          <button type="submit">Masuk</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
