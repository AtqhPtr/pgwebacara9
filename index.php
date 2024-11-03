<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Acara 9</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
		<style>
                #map {
                    width: 100%;
                    height: 600px;
                    border: 2px solid #6cd624; /* Tambahkan border pada peta */
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan untuk efek 3D */
                }

                #container {
                    display: flex;
                    gap: 20px; /* Beri jarak antar kontainer */
                    padding: 20px; /* Tambahkan padding agar lebih lega */
                }

                #table-container, #map-container {
                    width: 50%;
                    padding: 10px;
                    border: 2px solid #e0e0e0; /* Border pada kontainer */
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan */
                }

                table {
                    width: 100%;
                    border-radius: 10px;
                    overflow: hidden;
                    border: 1px solid #6cd624;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan pada tabel */
                    margin-bottom: 0; /* Hapus margin bawah */
                }

                thead {
                    background-color: #6cd624;
                }

                th, td {
                    padding: 10px;
                }

                body {
                    background-color: #f8f9fa; /* Tambahkan warna latar belakang */
                }

                .navbar-custom {
                    background: linear-gradient(90deg, #6cd624, #009688); /* Warna gradien */
                    border-bottom: 3px solid #6cd624; /* Tambahkan garis bawah */
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
                    padding: 10px; /* Beri jarak pada navbar */
                }

                .navbar-brand {
                    font-weight: bold;
                    font-size: 1.5rem; /* Perbesar ukuran font */
                    color: white; /* Ubah warna teks navbar menjadi putih */
                    text-transform: uppercase; /* Jadikan huruf kapital semua */
                    letter-spacing: 2px; /* Tambahkan jarak antar huruf */
                    transition: color 0.3s ease-in-out; /* Animasi transisi untuk hover */
                    text-align: left; /* Pastikan teks dalam navbar rata kiri */
                }
                .navbar-brand:hover {
                    color: #f8f9fa; /* Warna teks saat hover */
                }
                .navbar img {
                    margin-right: 10px; /* Tambahkan jarak antara logo dan teks */
                    filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.2)); /* Tambahkan bayangan pada logo */
                }
</style>

</style>
		</style>
	</head>
	<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <nav class="navbar bg-body-tertiary navbar-custom">
        <div class="container-fluid justify-content-left">
                <a class="navbar-brand" href="#">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/92/Lambang_Kabupaten_Sleman.png" alt="" width="60" height="40" class="d-inline-block align-text-top"><br>
                    WEB GIS <br> Kabupaten Sleman
                </a>
            </div>
        </nav>

        <div id="container">
        <div id="table-container">

        <h2>Daftar Data Penduduk</h2>

        <!-- Tambah Data Button -->
        <div class="d-flex justify-content-end mb-3">
            <a href="input.php" class="btn btn-success">Tambah Data</a>
        </div>

            <!-- Tabel Data Penduduk -->
            <table class="table table-striped">
            <thead>
                <tr>
                <th>Kecamatan</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Luas</th>
                <th>Jumlah Penduduk</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Create connection
                $conn = new mysqli("localhost", "root", "", "latihan");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM penduduk";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["kecamatan"]."</td>";
                        echo "<td>".$row["longitude"]."</td>";
                        echo "<td>".$row["latitude"]."</td>";
                        echo "<td>".$row["luas"]."</td>";
                        echo "<td>".$row["jumlah_penduduk"]."</td>";
    
                // Tambahkan tombol Update dan Delete
                echo "<td>
                    <a href='update.php?id=".$row["id"]."' class='btn btn-warning btn-sm'>Update</a> 
                    <a href='delete.php?id=".$row["id"]."' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>
                </td>";
                echo "</tr>";
            }
        }
                    else {
                        echo "<tr><td colspan = '3'>0 results </td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
            </table>
        </div>
        <div id="map-container">
            <div id="map"></div>
        </div>
                </div>



		<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
		<script>
			// Inisialisasi peta
			var map = L.map("map").setView([-7.8033358,110.3755269], 13);

			// Tile Layer Base Map

            var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution:
                            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            });


            var rupabumiindonesia = L.tileLayer('https://geoservices.big.go.id/rbi/rest/services/BASEMAP/Rupabumi_Indonesia/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Badan Informasi Geospasial'
            });

            // Menambahkan basemap ke dalam peta

        <?php
        // Create connection
        $conn = new mysqli("localhost", "root", "", "latihan");

            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM penduduk";
            $result = $conn->query($sql);

            // Check if delete action is triggered
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    $lat = $row["latitude"];
                    $long = $row["longitude"];
                    $info = $row["kecamatan"];
                    echo "L.marker([$lat,$long]).addTo(map).bindPopup('$info');";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>

            // Control Layer
            var baseMaps = {
                "OpenStreetMap": osm,
                "Esri World Imagery": Esri_WorldImagery,
                "Rupa Bumi Indonesia": rupabumiindonesia,
            };
            
            L.control.layers(baseMaps).addTo(map);


            // Scale
            var scale = L.control.scale({position:"bottomright", imperial: false});
            scale.addTo(map);


        </script>
	</body>
</html>