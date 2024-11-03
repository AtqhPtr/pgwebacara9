<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "latihan");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses input data jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kecamatan = $_POST['kecamatan'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $luas = $_POST['luas'];
    $jumlah_penduduk = $_POST['jumlah_penduduk'];

    // Query untuk memasukkan data baru
    $sql = "INSERT INTO penduduk (kecamatan, longitude, latitude, luas, jumlah_penduduk) 
            VALUES ('$kecamatan', '$longitude', '$latitude', '$luas', '$jumlah_penduduk')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan";
        // Redirect ke halaman utama setelah insert
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!-- Form untuk menambahkan data baru -->
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Penduduk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-4">
    <h2>Tambah Data Penduduk</h2>
    <form method="POST" action="input.php">
        <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan:</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
        </div>
        
        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude:</label>
            <input type="text" class="form-control" id="longitude" name="longitude" required>
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude:</label>
            <input type="text" class="form-control" id="latitude" name="latitude" required>
        </div>

        <div class="mb-3">
            <label for="luas" class="form-label">Luas:</label>
            <input type="text" class="form-control" id="luas" name="luas" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk:</label>
            <input type="number" class="form-control" id="jumlah_penduduk" name="jumlah_penduduk" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
