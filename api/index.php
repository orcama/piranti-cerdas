<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Sensor Keamanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            line-height: 1.6;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 25px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        .sensor-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 6px;
        }
        .sensor-label {
            font-weight: bold;
            color: #555;
        }
        .sensor-value {
            color: #333;
        }
        .status-on {
            color: green;
            font-weight: bold;
        }
        .status-off {
            color: red;
            font-weight: bold;
        }
        .last-update {
            text-align: center;
            color: #777;
            font-size: 0.9em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Status Sensor Keamanan</h1>
        <?php
        // Koneksi ke database
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "tugas2pirdas";
        $conn = new mysqli($host, $user, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil data terakhir
        $query = "SELECT angleX, angleY, posisi_datar, status_led, status_buzzer, waktu_input 
                  FROM sensor_keamanan 
                  ORDER BY id DESC 
                  LIMIT 1";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <div class="sensor-info">
                <span class="sensor-label">Sudut X:</span>
                <span class="sensor-value"><?php echo number_format($row['angleX'], 2); ?>°</span>
            </div>
            <div class="sensor-info">
                <span class="sensor-label">Sudut Y:</span>
                <span class="sensor-value"><?php echo number_format($row['angleY'], 2); ?>°</span>
            </div>
            <div class="sensor-info">
                <span class="sensor-label">Posisi:</span>
                <span class="sensor-value <?php echo ($row['posisi_datar'] == 'Datar') ? 'status-on' : 'status-off'; ?>">
                    <?php echo $row['posisi_datar']; ?>
                </span>
            </div>
            <div class="sensor-info">
                <span class="sensor-label">Status LED:</span>
                <span class="sensor-value <?php echo ($row['status_led'] == 'Nyala') ? 'status-on' : 'status-off'; ?>">
                    <?php echo $row['status_led']; ?>
                </span>
            </div>
            <div class="sensor-info">
                <span class="sensor-label">Status Buzzer:</span>
                <span class="sensor-value <?php echo ($row['status_buzzer'] == 'Aktif') ? 'status-on' : 'status-off'; ?>">
                    <?php echo $row['status_buzzer']; ?>
                </span>
            </div>
            <div class="last-update">
                Terakhir diperbarui: <?php echo $row['waktu_input']; ?>
            </div>
            <?php
        } else {
            echo "<p style='text-align: center; color: #777;'>Tidak ada data sensor yang tersedia</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>