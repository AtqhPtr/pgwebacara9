<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "latihan");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inisialisasi variabel kosong
$kecamatan = $longitude = $latitude = $luas = $jumlah_penduduk = "";

// Periksa apakah parameter id ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data berdasarkan id
    $sql = "SELECT * FROM penduduk WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data dari database
        $row = $result->fetch_assoc();
        $kecamatan = $row["kecamatan"];
        $longitude = $row["longitude"];
        $latitude = $row["latitude"];
        $luas = $row["luas"];
        $jumlah_penduduk = $row["jumlah_penduduk"];
    } else {
        echo "Data tidak ditemukan.";
    }
}

// Proses update data jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $kecamatan = $_POST['kecamatan'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $luas = $_POST['luas'];
    $jumlah_penduduk = $_POST['jumlah_penduduk'];

    // Query untuk update data
    $sql = "UPDATE penduduk SET kecamatan='$kecamatan', longitude='$longitude', latitude='$latitude', luas='$luas', jumlah_penduduk='$jumlah_penduduk' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate";
        // Redirect ke halaman utama setelah update
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!-- Form untuk update data -->
<!DOCTYPE html>
<html>
<head>
    <title>Update Data Penduduk</title>
</head>
<body>

<h2>Update Data Penduduk</h2>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="kecamatan">Kecamatan:</label><br>
    <input type="text" id="kecamatan" name="kecamatan" value="<?php echo $kecamatan; ?>"><br><br>

    <label for="longitude">Longitude:</label><br>
    <input type="text" id="longitude" name="longitude" value="<?php echo $longitude; ?>"><br><br>

    <label for="latitude">Latitude:</label><br>
    <input type="text" id="latitude" name="latitude" value="<?php echo $latitude; ?>"><br><br>

    <label for="luas">Luas:</label><br>
    <input type="text" id="luas" name="luas" value="<?php echo $luas; ?>"><br><br>

    <label for="jumlah_penduduk">Jumlah Penduduk:</label><br>
    <input type="text" id="jumlah_penduduk" name="jumlah_penduduk" value="<?php echo $jumlah_penduduk; ?>"><br><br>

    <input type="submit" value="Update">
</form>

</body>
</html>
